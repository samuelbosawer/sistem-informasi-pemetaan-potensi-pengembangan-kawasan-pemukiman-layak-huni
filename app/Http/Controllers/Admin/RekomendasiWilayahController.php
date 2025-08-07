<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distrik;
use App\Models\JenisKriteria;
use App\Models\Periode;
use App\Models\Rekomendasi;
use App\Models\Strategi;
use App\Models\Topsis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RekomendasiWilayahController extends Controller
{
    public function index(Request $request)
    {
        $dates = Periode::select('created_at')
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();
        $lates = Periode::select('created_at')
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->first();
        $query = Periode::query();
        if ($request->filled('tanggal')) {
            $query->where('created_at', $request->tanggal);
        }elseif(isset($lates->created_at)){
            $query->where('created_at', $lates->created_at) ?? null;
        }else{

        }
        $datas = $query->distinct()->get();
        return view('admin.periode.index', compact('datas', 'dates'));
    }

    public function pdf(Request $request)
    {
         $dates = Periode::select('created_at')
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();
        $lates = Periode::select('created_at')
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->first();
        $query = Periode::query();
        if ($request->filled('tanggal')) {
            $query->where('created_at', $request->tanggal);
        }elseif(isset($lates->created_at)){
            $query->where('created_at', $lates->created_at) ?? null;
        }else{

        }
        $datas = $query->distinct()->get();
        $title = 'Laporan Periode Wilayah';
        $data = [
            'title' => $title,
            'ranking' => $datas
        ];
        $pdf = Pdf::loadView('admin.rwilayah.pdf', $data);
        return $pdf->stream('laporan-periode-wilayah.pdf');
    }


    public function create()
    {
        $strategi = Strategi::get();
        $distrik = Distrik::get();

        return view('admin.rwilayah.create', compact('strategi', 'distrik'));
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

        return view('admin.rwilayah.create', compact('strategi', 'distrik'));
    }



    public function edit(string $id)
    {
        $strategi = Strategi::get();
        $distrik = Distrik::get();

        return view('admin.rwilayah.create', compact('strategi', 'distrik'));
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
