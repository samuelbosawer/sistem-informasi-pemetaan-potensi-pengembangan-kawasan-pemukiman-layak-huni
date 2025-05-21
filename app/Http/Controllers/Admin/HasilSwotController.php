<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKriteria;
use Illuminate\Http\Request;

class HasilSwotController extends Controller
{
    public function index(Request $request)
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



        $strength = JenisKriteria::where('faktor', 'Strengths')->get();
        $weakness = JenisKriteria::where('faktor', 'Weaknesses')->get();
        $opportunity = JenisKriteria::where('faktor', 'Opportunities')->get();
        $threat = JenisKriteria::where('faktor', 'Threats')->get();

        $sScore = $strength->sum(fn($x) => $x->bobot * $x->rating);
        $wScore = $weakness->sum(fn($x) => $x->bobot * $x->rating);
        $oScore = $opportunity->sum(fn($x) => $x->bobot * $x->rating);
        $tScore = $threat->sum(fn($x) => $x->bobot * $x->rating);

        $x = $sScore - $wScore;
        $y = $oScore - $tScore;

        if ($x > 0 && $y > 0) {
            $strategi = "SO - Agresif";
        } elseif ($x > 0 && $y < 0) {
            $strategi = "ST - Diversifikasi";
        } elseif ($x < 0 && $y > 0) {
            $strategi = "WO - Turnaround";
        } else {
            $strategi = "WT - Defensif";
        }



        return view('admin.swot.index', compact('datas', 'nilaiA', 'nilaiB','totalNilaiA','totalNilaiB'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create() {

    }

    public function store(Request $request) {}

    public function show(string $id) {}


    public function edit(string $id) {}

    public function update(Request $request, string $id) {}


    public function destroy(string $id) {}
}
