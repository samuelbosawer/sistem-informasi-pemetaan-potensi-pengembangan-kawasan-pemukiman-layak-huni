<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKriteria;
use App\Models\Strategi;
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

 // Ambil data per faktor SWOT
    $strength = JenisKriteria::where('faktor', 'Strengths')->get();
    $weakness = JenisKriteria::where('faktor', 'Weaknesses')->get();
    $opportunity = JenisKriteria::where('faktor', 'Opportunities')->get();
    $threat = JenisKriteria::where('faktor', 'Threats')->get();


    // // Hitung skor total
    // $sScore = $strength->sum(fn($x) => $x->bobot * $x->rating);
    // $wScore = $weakness->sum(fn($x) => $x->bobot * $x->rating);
    // $oScore = $opportunity->sum(fn($x) => $x->bobot * $x->rating);
    // $tScore = $threat->sum(fn($x) => $x->bobot * $x->rating);

    // $x = $sScore - $wScore;
    // $y = $oScore - $tScore;

    // // Tentukan tipe strategi berdasarkan hasil perhitungan
    // if ($x > 0 && $y > 0) {
    //     $tipe = 'SO';
    // } elseif ($x > 0 && $y < 0) {
    //     $tipe = 'ST';
    // } elseif ($x < 0 && $y > 0) {
    //     $tipe = 'WO';
    // } else {
    //     $tipe = 'WT';
    // }

    // Ambil strategi berdasarkan tipe yang dihitung
    // $strategi = Strategi::where('tipe', $tipe)->pluck('keterangan');

    // // Ambil kode_kriteria berdasarkan tipe
    // $kodeKriteria = match ($tipe) {
    //     'SO' => [
    //         'Strengths' => $strength->pluck('kode_kriteria'),
    //         'Opportunities' => $opportunity->pluck('kode_kriteria')
    //     ],
    //     'ST' => [
    //         'Strengths' => $strength->pluck('kode_kriteria'),
    //         'Threats' => $threat->pluck('kode_kriteria')
    //     ],
    //     'WO' => [
    //         'Weaknesses' => $weakness->pluck('kode_kriteria'),
    //         'Opportunities' => $opportunity->pluck('kode_kriteria')
    //     ],
    //     'WT' => [
    //         'Weaknesses' => $weakness->pluck('kode_kriteria'),
    //         'Threats' => $threat->pluck('kode_kriteria')
    //     ],
    // };


    $so = Strategi::where('tipe', 'SO')->get()->unique(fn($s) => $s->satu_id . '-' . $s->dua_id . '-' . $s->tiga_id . '-' . $s->empat_id);
    $wo = Strategi::where('tipe', 'WO')->get()->unique(fn($s) => $s->satu_id . '-' . $s->dua_id . '-' . $s->tiga_id . '-' . $s->empat_id);
    $st = Strategi::where('tipe', 'ST')->get()->unique(fn($s) => $s->satu_id . '-' . $s->dua_id . '-' . $s->tiga_id . '-' . $s->empat_id);
    $wt = Strategi::where('tipe', 'WT')->get()->unique(fn($s) => $s->satu_id . '-' . $s->dua_id . '-' . $s->tiga_id . '-' . $s->empat_id);


        return view('admin.swot.index', compact('datas', 'nilaiA', 'nilaiB','totalNilaiA','totalNilaiB','so','wo','st','wt'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create() {

    }

    public function store(Request $request) {}

    public function show(string $id) {}


    public function edit(string $id) {}

    public function update(Request $request, string $id) {}


    public function destroy(string $id) {}
}
