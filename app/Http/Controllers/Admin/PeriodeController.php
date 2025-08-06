<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKriteria;
use App\Models\Periode;
use App\Models\Topsis;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index(Request $request) {}

    public function create()
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

        foreach ($ranking as $index => $data) {
            Periode::create([
                'peringkat'    => $index + 1, // Peringkat dimulai dari 1
                'kode_distrik' => $data['distrik'],
                'nilai'        => $data['nilai'],
            ]);
        }

        alert()->success('Berhasil', 'Data berhasil disimpan')->autoclose(3000);
        return redirect()->route('dashboard.rekomendasi');
    }

    public function store(Request $request) {}

    public function show(string $id) {}


    public function edit(string $id) {}

    public function update(Request $request, string $id) {}


    public function destroy(string $id) {}
}
