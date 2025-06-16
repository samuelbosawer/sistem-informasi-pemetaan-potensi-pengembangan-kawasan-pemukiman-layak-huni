<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distrik;
use App\Models\JenisKriteria;
use App\Models\Rekomendasi;
use App\Models\Strategi;
use App\Models\Topsis;
use Illuminate\Http\Request;

class RekomendasiWilayahController extends Controller
{
    public function index(Request $request)
    {

           // Data Penilaian dan Bobot
        $data = Topsis::get();

        $kriterias = $data->pluck('kode_kriteria')->unique()->values();
        $distriks = $data->pluck('kode_distrik')->unique()->values();

        // Ambil data jenis kriteria untuk bobot dan label
        $jenisKriteria = JenisKriteria::all()->keyBy('kode_kriteria');

        // Pencarian Nilai IFAS dan EFAS
        $nilaiA = JenisKriteria::whereIn('faktor', ['Strengths', 'Weaknesses'])->get();
        $totalNilaiA = $nilaiA->sum('penilaian');

        $nilaiB = JenisKriteria::whereIn('faktor', ['Opportunities', 'Threats'])->get();
        $totalNilaiB = $nilaiB->sum('penilaian');

        // Matrix nilai dan label
        $matrix = [];
        $labels = [];
        $weights = [];
        $scores = [];
        $rating = [];
        $weighted = [];
        $topsisIds = [];

        // Siapkan array jumlah rating per kriteria
        $ratingTotals = [];

        foreach ($data as $item) {
            $kodeKriteria = $item->kode_kriteria;
            $kodeDistrik = $item->kode_distrik;

            $matrix[$kodeKriteria][$kodeDistrik] = $item->nilai;
            $topsisIds[$kodeKriteria][$kodeDistrik] = $item->id;

            // Hitung total rating per kriteria
            if (!isset($ratingTotals[$kodeKriteria])) {
                $ratingTotals[$kodeKriteria] = 0;
            }
            $ratingTotals[$kodeKriteria] += $item->rating;

            // Ambil label dan penilaian dari JenisKriteria
            $kriteriaInfo = $jenisKriteria[$kodeKriteria] ?? null;

            if ($kriteriaInfo) {
                $labels[$kodeKriteria] = $kriteriaInfo->label;

                // Hitung bobot berdasarkan faktor
                if (in_array($kriteriaInfo->faktor, ['Strengths', 'Weaknesses'])) {
                    $bobot = $totalNilaiA > 0 ? $kriteriaInfo->penilaian / $totalNilaiA : 0;
                } elseif (in_array($kriteriaInfo->faktor, ['Opportunities', 'Threats'])) {
                    $bobot = $totalNilaiB > 0 ? $kriteriaInfo->penilaian / $totalNilaiB : 0;
                } else {
                    $bobot = 0;
                }

                $weights[$kodeKriteria] = round($bobot, 3);
                $rating[$kodeKriteria] = $kriteriaInfo->rating;
            } else {
                $labels[$kodeKriteria] = '-';
                $weights[$kodeKriteria] = 0;
            }
        }

        // Hitung skor akhir per kriteria
        $scores = [];
        foreach ($kriterias as $kriteria) {
            $totalRating = $rating[$kriteria] ?? 0;
            $bobot = $weights[$kriteria] ?? 0;
            $scores[$kriteria] = round($totalRating * $bobot, 3);
        }

        // Normalisasi
        $normal = [];
        foreach ($kriterias as $kriteria) {
            $values = collect($distriks)->map(fn($d) => $matrix[$kriteria][$d] ?? 0);
            $sqrtSum = sqrt($values->map(fn($v) => $v * $v)->sum());

            foreach ($distriks as $distrik) {
                $normal[$kriteria][$distrik] = $sqrtSum != 0
                    ? round(($matrix[$kriteria][$distrik] ?? 0) / $sqrtSum, 3)
                    : 0;
            }
        }

        foreach ($kriterias as $kriteria) {
            foreach ($distriks as $distrik) {
                $normalValue = $normal[$kriteria][$distrik] ?? 0;
                $skor = $scores[$kriteria] ?? 0;
                $weighted[$kriteria][$distrik] = round($normalValue * $skor, 3);
            }
        }


        $idealPositive = [];
        $idealNegative = [];

        foreach ($kriterias as $kriteria) {
            $values = collect($distriks)->map(fn($d) => $weighted[$kriteria][$d] ?? 0);

            $idealPositive[$kriteria] = $values->max();
            $idealNegative[$kriteria] = $values->min();
        }


        $jarakIdealPositif = [];
        $jarakIdealNegatif = [];

        foreach ($distriks as $distrik) {
            $sumPositif = 0;
            $sumNegatif = 0;

            foreach ($kriterias as $kriteria) {
                $value = $weighted[$kriteria][$distrik] ?? 0;
                $aPlus = $idealPositive[$kriteria] ?? 0;
                $aMinus = $idealNegative[$kriteria] ?? 0;

                $sumPositif += pow($value - $aPlus, 2);
                $sumNegatif += pow($value - $aMinus, 2);
            }

            $jarakIdealPositif[$distrik] = round(sqrt($sumPositif), 3);
            $jarakIdealNegatif[$distrik] = round(sqrt($sumNegatif), 3);
        }

$distrikList = Distrik::whereIn('kode_distrik', $distriks)->pluck('nama_distrik', 'kode_distrik');
$rekomendasi = Rekomendasi::with('strategi.satu', 'strategi.dua', 'strategi.tiga', 'strategi.empat', 'distrik')->get();

$preferensi = [];
foreach ($distriks as $distrik) {
    $dPlus = $jarakIdealPositif[$distrik] ?? 0;
    $dMinus = $jarakIdealNegatif[$distrik] ?? 0;
    $preferensi[$distrik] = ($dPlus + $dMinus) > 0
        ? round($dMinus / ($dPlus + $dMinus), 4)
        : 0;
}

$ranking = collect($preferensi)
    ->sortDesc()
    ->map(function ($value, $kodeDistrik) use ($distrikList, $rekomendasi) {
        // Ambil semua rekomendasi yang sesuai dengan kode distrik
        $rekoms = $rekomendasi->where('kode_distrik', $kodeDistrik);

        // Kategorisasi strategi per tipe
        $tipeStrategi = [];
        $rekomendasiIds = [];

        foreach ($rekoms as $rekom) {
            $tipe = $rekom->strategi->tipe ?? 'Tidak Diketahui';
            $rekomendasiIds[] = $rekom->id;

            $strategiList = collect([
                optional($rekom->strategi->satu)->kriteria,
                optional($rekom->strategi->dua)->kriteria,
                optional($rekom->strategi->tiga)->kriteria,
                optional($rekom->strategi->empat)->kriteria,
            ])->filter()->unique()->values()->all();

            $tipeStrategi[$tipe] = array_unique(array_merge($tipeStrategi[$tipe] ?? [], $strategiList));
        }

        // Ambil data distrik lengkap dengan geojson
        $distrik = Distrik::where('kode_distrik', $kodeDistrik)->first();

        return [
            'kode_distrik' => $kodeDistrik,
            'nama_distrik' => $distrik?->nama_distrik ?? 'Tidak Diketahui',
            'nilai' => $value,
            'strategi_bertipe' => $tipeStrategi,
            'rekomendasi_ids' => array_unique($rekomendasiIds),
            'geojson' => $distrik?->geojson ?? null,
        ];
    })
    ->values()
    ->all();


        return view('admin.rwilayah.index',compact('ranking'));

    }

    public function create()
    {
        $strategi = Strategi::get();
        $distrik = Distrik::get();

         return view('admin.rwilayah.create',compact('strategi','distrik'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'strategi_id' => 'required',
                'strategi_id' => 'required',

            ],
            [
                'strategi_id.required' => 'Tidak boleh kosong',
                'strategi_id.required' => 'Tidak boleh kosong',
            ]
        );


        $data = new Rekomendasi();
        $data->strategi_id   = $request->strategi_id;
        $data->kode_distrik   = $request->kode_distrik;
        $data->save();


        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.rekomendasi');
    }

    public function show(string $id)
    {
        $strategi = Strategi::get();
        $distrik = Distrik::get();

         return view('admin.rwilayah.create',compact('strategi','distrik'));
    }


    public function edit(string $id)
    {
        $strategi = Strategi::get();
        $distrik = Distrik::get();

         return view('admin.rwilayah.create',compact('strategi','distrik'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'strategi_id' => 'required',
                'strategi_id' => 'required',

            ],
            [
                'strategi_id.required' => 'Tidak boleh kosong',
                'strategi_id.required' => 'Tidak boleh kosong',
            ]
        );


        $data = Rekomendasi::find($id);
        $data->strategi_id   = $request->strategi_id;
        $data->kode_distrik   = $request->kode_distrik;
        $data->update();
        alert()->success('Berhasil', 'ubah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.rekomendasi');
    }


    public function destroy(string $id)
    {
        $data = Rekomendasi::find($id);
        $data->delete();
        return redirect()->back();
    }
}
