<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distrik;
use App\Models\JenisKriteria;
use App\Models\Peringkat;
use App\Models\Topsis;
use Illuminate\Http\Request;

class TopsisController extends Controller
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

    $tipe = $jenisKriteria[$kriteria]->label; // Contoh: ['C1' => 'BENEFIT', 'C2' => 'COST']


    if ($tipe === 'Cost') {
        $idealPositive[$kriteria] = $values->min();
        $idealNegative[$kriteria] = $values->max();
    } else {
         $idealPositive[$kriteria] = $values->max();
        $idealNegative[$kriteria] = $values->min();

    }
}

$jarakIdealPositif = [];
$jarakIdealNegatif = [];

foreach ($distriks as $distrik) {
    $sumPositif = 0;
    $sumNegatif = 0;

    foreach ($kriterias as $kriteria) {
        // Nilai terbobot v_ij
        $value = $weighted[$kriteria][$distrik] ?? 0;


        // Solusi ideal positif dan negatif
        $aPlus = $idealPositive[$kriteria] ?? 0;
        $aMinus = $idealNegative[$kriteria] ?? 0;


        // Hitung selisih kuadrat untuk D+ dan D-
        $sumPositif += pow($value - $aPlus, 2);
        $sumNegatif += pow($value - $aMinus, 2);

    }

    // Akar dari total selisih kuadrat
    $jarakIdealPositif[$distrik] = round(sqrt($sumPositif), 3);
    $jarakIdealNegatif[$distrik] = round(sqrt($sumNegatif), 3);

}

// 1. Hitung preferensi dan ranking TOPSIS
$preferensi = [];

foreach ($distriks as $distrik) {
    $dPlus = $jarakIdealPositif[$distrik] ?? 0;
    $dMinus = $jarakIdealNegatif[$distrik] ?? 0;

    // Cek apakah pembagi tidak nol untuk menghindari pembagian 0/0
    if (($dPlus + $dMinus) != 0) {
        $preferensi[$distrik] = round($dMinus / ($dPlus + $dMinus), 4);
    } else {
        // Jika jarak total 0 (tidak normal), nilai preferensi dianggap 0
        $preferensi[$distrik] = 0;
    }
}

// 2. Buat ranking dari hasil preferensi
$ranking = collect($preferensi)
    ->sortDesc()
    ->map(function ($value, $key) {
        return ['distrik' => $key, 'nilai' => $value];
    })
    ->values()
    ->all();

// // 3. Ambil semua strategi (tipe: SO, ST, WO, WT) dan group berdasarkan peringkat
// $strategiByPeringkat = Peringkat::get()
//     ->groupBy('peringkat');

// // 4. Gabungkan ranking + strategi (dengan keterangan)
// $hasilGabungan = collect($ranking)->map(function ($item, $index) use ($strategiByPeringkat) {
//     $peringkat = $index + 1;
//     $strategiList = $strategiByPeringkat[$peringkat] ?? collect();
//     $tipe = $strategiByPeringkat[$peringkat] ?? collect();

//    $strategiListFormatted = $strategiList->map(function ($item) {
//     return [
//         'tipe'       => $item->tipe,
//         'keterangan' => $item->keterangan,
//     ];
// })->values()->all();

//     return [
//         'distrik'   => $item['distrik'],
//         'nilai'     => $item['nilai'],
//         'peringkat' => $peringkat,
//         'strategi'  => $strategiListFormatted, // tipe => array of strategi + keterangan
//     ];
// });




// dd($hasilGabungan);

        return view('admin.topsis.index', compact(
            'kriterias',
            'distriks',
            'matrix',
            'labels',
            'weights',
            'scores',
            'normal',
            'weighted',
            'idealPositive',
            'idealNegative',
            'jarakIdealPositif',
            'jarakIdealNegatif',
            'preferensi',
            'ranking',
            'topsisIds',
            // 'hasilGabungan'


        ));
    }

    public function create()
    {
        $distriks = Distrik::get();
        $kriterias = JenisKriteria::get();
        return view('admin.topsis.create', compact('distriks', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'kode_distrik' => 'required',
                'kode_kriteria' => 'required',
                'nilai' => 'required|numeric',
            ],
            [
                'kode_distrik.required' => 'Tidak boleh kosong',
                'kode_kriteria.required' => 'Tidak boleh kosong',
                'nilai.numeric' => 'Tidak boleh huruf',
                'nilai.required' => 'Tidak boleh kosong',
            ]
        );
        $data = new Topsis();
        $data->kode_distrik   = $request->kode_distrik;
        $data->kode_kriteria   = $request->kode_kriteria;
        $data->nilai   = $request->nilai;
        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.topsis');
    }

    public function edit($id)
    {
        $distriks = Distrik::get();
        $kriterias = JenisKriteria::get();
        $data = Topsis::where('id', $id)->first();
        $judul = 'Ubah Data Topsis';
        return view('admin.topsis.create', compact('distriks', 'kriterias', 'data','judul'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'kode_distrik' => 'required',
                'kode_kriteria' => 'required',
                'nilai' => 'required|numeric',
            ],
            [
                'kode_distrik.required' => 'Tidak boleh kosong',
                'kode_kriteria.required' => 'Tidak boleh kosong',
                'nilai.numeric' => 'Tidak boleh huruf',
                'nilai.required' => 'Tidak boleh kosong',
            ]
        );
        $data = Topsis::find($id);
        $data->kode_distrik   = $request->kode_distrik;
        $data->kode_kriteria   = $request->kode_kriteria;
        $data->nilai   = $request->nilai;
        $data->update();
        alert()->success('Berhasil', 'Ubah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.topsis');
    }


    public function destroy(string $id)
    {
        $data = Topsis::find($id);
        $data->delete();
        alert()->success('Berhasil', 'Data berhasil dihapus')->autoclose(3000);
        return redirect()->route('dashboard.topsis');
    }
}
