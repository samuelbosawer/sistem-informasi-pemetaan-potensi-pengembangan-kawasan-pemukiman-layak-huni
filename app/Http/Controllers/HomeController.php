<?php

namespace App\Http\Controllers;

use App\Models\Distrik;
use App\Models\JenisKriteria;
use App\Models\Rekomendasi;
use App\Models\Strategi;
use App\Models\Topsis;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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
                    'id_distrik' => $distrik?->id ?? 'Tidak Diketahui',
                    'nilai' => $value,
                    'strategi_bertipe' => $tipeStrategi,
                    'rekomendasi_ids' => array_unique($rekomendasiIds),
                    'geojson' => $distrik?->geojson ?? null,
                ];
            })
            ->values()
            ->all();


        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($ranking as $item) {
            if ($item['geojson']) {
                // Susun isi strategi jadi list HTML
                $strategiHtml = '';
                if (!empty($item['strategi_bertipe'])) {
                    foreach ($item['strategi_bertipe'] as $tipe => $daftarStrategi) {
                        $strategiHtml .= "<strong>Strategi $tipe:</strong><ul>";
                        foreach ($daftarStrategi as $s) {
                            $strategiHtml .= "<li>{$s}</li>";
                        }
                        $strategiHtml .= "</ul>";
                    }
                }

                $geojson['features'][] = [
                    'type' => 'Feature',
                    'geometry' => is_string($item['geojson']) ? json_decode($item['geojson'], true) : $item['geojson'],
                    'properties' => [
                        'kode_distrik' => $item['kode_distrik'],
                        'nama_distrik' => $item['nama_distrik'],
                        // 'id_distrik' => $item['id'],
                        'nilai' => $item['nilai'],
                        'keterangan' => "Skor preferensi: {$item['nilai']}<br><br>{$strategiHtml}<br><a href='/dashboard/peta/{$item['kode_distrik']}/detail' target='_blank'>Lihat Detail</a>"
                    ],
                ];
            }
        }
        $geojson  = json_encode($geojson);
        return view('visitor.home.index',compact('geojson'));
    }

    public function daftar()
    {
        return view('visitor.home.daftar');
    }

    public function daftar_store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                // 'phone' => 'required|unique:users,phone|max:13',
                'email' => 'required|unique:users,email|string',
                // 'date_of_birth' => 'required',
                'password'  => 'required|confirmed|min:8',
                'password_confirmation' => 'required_with:password|same:password|min:8'
            ],
            [
                'email.required' => 'Tidak boleh kosong',
                'email.unique' => 'Email sudah terdaftar',
                'nama.required' => 'Tidak boleh kosong',
                'jenis_kelamin.required' => 'Tidak boleh kosong',
                'password.required' => 'Tidak boleh kosong',
                'password.confirmed' => 'Password tidak sama',
            ]
        );
        $data = new User();

        $data->email   = $request->email;
        $data->nama   = $request->nama;
        $data->jenis_kelamin   = $request->jenis_kelamin;
        $data->password   = $request->password;
        $data->assignRole('');

        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('login');
    }


    public function swot()
    {

         // Data Penilaian dan Bobot
        $datas = JenisKriteria::where([['kriteria', '!=', Null],])->orderBy('id', 'asc')->get();

        //Pencarian Nilai IFAS dan EFAS
        $nilaiA = JenisKriteria::whereIn('faktor', ['Strengths', 'Weaknesses'])
            ->orderBy('id', 'asc')
            ->get();
        $totalNilaiA = $nilaiA->sum('penilaian');

        $nilaiB = JenisKriteria::whereIn('faktor', ['Opportunities', 'Threats'])
            ->orderBy('id', 'asc')
            ->get();
        $totalNilaiB = $nilaiB->sum('penilaian');

      // Ambil data per faktor SWOT
    $strength = JenisKriteria::where('faktor', 'Strengths')->get();
    $weakness = JenisKriteria::where('faktor', 'Weaknesses')->get();
    $opportunity = JenisKriteria::where('faktor', 'Opportunities')->get();
    $threat = JenisKriteria::where('faktor', 'Threats')->get();



    $so = Strategi::where('tipe', 'SO')->get()->unique(fn($s) => $s->satu_id . '-' . $s->dua_id . '-' . $s->tiga_id . '-' . $s->empat_id);
    $wo = Strategi::where('tipe', 'WO')->get()->unique(fn($s) => $s->satu_id . '-' . $s->dua_id . '-' . $s->tiga_id . '-' . $s->empat_id);
    $st = Strategi::where('tipe', 'ST')->get()->unique(fn($s) => $s->satu_id . '-' . $s->dua_id . '-' . $s->tiga_id . '-' . $s->empat_id);
    $wt = Strategi::where('tipe', 'WT')->get()->unique(fn($s) => $s->satu_id . '-' . $s->dua_id . '-' . $s->tiga_id . '-' . $s->empat_id);

        return view('visitor.home.swot',compact('datas', 'nilaiA', 'nilaiB','totalNilaiA','totalNilaiB','so','wo','st','wt'))->with('i', (request()->input('page', 1) - 1) * 10);
    }


    public function topsis()
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


        return view('visitor.home.topsis', compact(
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

    public function rekomendasi()
    {

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


        return view('visitor.home.rekomendasi',compact('ranking'));

    }

    public function tentang()
    {
        return view('visitor.home.tentang');
    }
     public function kontak()
    {
         return view('visitor.home.kontak');
    }
}
