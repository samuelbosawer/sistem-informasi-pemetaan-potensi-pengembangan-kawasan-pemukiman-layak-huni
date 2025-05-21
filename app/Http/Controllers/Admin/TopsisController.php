<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topsis;
use Illuminate\Http\Request;

class TopsisController extends Controller
{
    public function index(Request $request)
    {

        // Data Penilaian dan Bobot
       $data = Topsis::get();

    $kriterias = $data->pluck('kode_kriteria')->unique()->sort()->values();
    $distriks = $data->pluck('kode_distrik')->unique()->sort()->values();

    $matrix = [];
    $labels = [];
    foreach ($data as $item) {
        $matrix[$item->kode_kriteria][$item->kode_distrik] = $item->nilai;
        $labels[$item->kode_kriteria] = $item->label;
    }

    // Manual bobot (dari input pengguna)
    $manualBobot = [
        'C1' => 0.463, 'C2' => 0.463, 'C3' => 0.296, 'C4' => 0.296,
        'C5' => 0.463, 'C6' => 0.463, 'C7' => 0.167, 'C8' => 0.167,
        'C9' => 0.167, 'C10' => 0.167, 'C11' => 0.296, 'C12' => 0.463,
        'C13' => 0.167, 'C14' => 0.074, 'C15' => 0.471, 'C16' => 0.265,
        'C17' => 0.118, 'C18' => 0.265, 'C19' => 0.735, 'C20' => 0.118,
        'C21' => 0.265, 'C22' => 0.265, 'C23' => 0.265, 'C24' => 0.118,
        'C25' => 0.118, 'C26' => 0.118,
    ];

    // Normalisasi
    $normal = [];
    foreach ($kriterias as $kriteria) {
        $values = collect($distriks)->map(fn($d) => $matrix[$kriteria][$d] ?? 0);
        $sqrtSum = sqrt($values->map(fn($v) => $v * $v)->sum());

        foreach ($distriks as $distrik) {
            $normal[$kriteria][$distrik] = $sqrtSum != 0 ? round(($matrix[$kriteria][$distrik] ?? 0) / $sqrtSum, 4) : 0;
        }
    }

    // Matriks Terbobot
    $terbobot = [];
    foreach ($kriterias as $kriteria) {
        foreach ($distriks as $distrik) {
            $terbobot[$kriteria][$distrik] = round($normal[$kriteria][$distrik] * $manualBobot[$kriteria], 4);
        }
    }

    // Solusi Ideal Positif dan Negatif
    $idealPositif = [];
    $idealNegatif = [];
    foreach ($kriterias as $kriteria) {
        $values = collect($terbobot[$kriteria])->values();
        if ($labels[$kriteria] === 'BENEFIT') {
            $idealPositif[$kriteria] = $values->max();
            $idealNegatif[$kriteria] = $values->min();
        } else {
            $idealPositif[$kriteria] = $values->min();
            $idealNegatif[$kriteria] = $values->max();
        }
    }

    // Jarak ke solusi ideal
    $jarakPositif = [];
    $jarakNegatif = [];

    foreach ($distriks as $distrik) {
        $sumPlus = 0;
        $sumMinus = 0;
        foreach ($kriterias as $kriteria) {
            $val = $terbobot[$kriteria][$distrik];
            $sumPlus += pow($val - $idealPositif[$kriteria], 2);
            $sumMinus += pow($val - $idealNegatif[$kriteria], 2);
        }
        $jarakPositif[$distrik] = round(sqrt($sumPlus), 4);
        $jarakNegatif[$distrik] = round(sqrt($sumMinus), 4);
    }

    // Ranking (preferensi)
    $ranking = [];
    foreach ($distriks as $distrik) {
        $dPlus = $jarakPositif[$distrik];
        $dMinus = $jarakNegatif[$distrik];
        $ranking[$distrik] = round($dMinus / ($dPlus + $dMinus), 4);
    }

    arsort($ranking); // Urutkan dari terbaik

    return view('admin.topsis.index', compact(
        'kriterias', 'distriks',
        'matrix', 'normal', 'terbobot',
        'idealPositif', 'idealNegatif',
        'jarakPositif', 'jarakNegatif',
        'ranking', 'manualBobot', 'labels'
    ));

    }

}
