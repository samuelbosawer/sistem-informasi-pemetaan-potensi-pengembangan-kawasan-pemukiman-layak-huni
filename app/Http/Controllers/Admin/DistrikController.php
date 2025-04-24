<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distrik;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DistrikController extends Controller
{
    public function index(Request $request)
    {

        $datas = Distrik::where([
            ['nama_distrik', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('nama_distrik', 'LIKE', '%' . $s . '%')
                        ->orWhere('keterangan', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->orderBy('id', 'desc')->paginate(10);
        return view('admin.distrik.index',compact('datas'))->with('i',(request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {

        return view('admin.distrik.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'nama_distrik' => 'required',
                'geojson' => 'json',
            ],
            [
                'nama_distrik.required' => 'Tidak boleh kosong',
                'geojson.json' => 'Harus format json',
            ]
        );
        $data = new Distrik();

        $data->nama_distrik   = $request->nama_distrik;
        $data->keterangan   = $request->keterangan;
        $data->geojson   = $request->geojson;

        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.distrik');
    }

    public function show(string $id)
    {
        $judul = 'Detail Data Distrik';
        $data = Distrik::where('id',$id)->first();
        return view('admin.distrik.create', compact('data','judul'));
    }


    public function edit(string $id)
    {
        $data = Distrik::where('id',$id)->first();
        $judul = 'Ubah Data Distrik';
        return view('admin.distrik.create', compact('data','judul'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate(
            [
                'nama_distrik' => 'required',
                'geojson' => 'json',
            ],
            [
                'nama_distrik.required' => 'Tidak boleh kosong',
                'geojson.json' => 'Harus format json',
            ]
        );
        $data = Distrik::find($id);
        $data->nama_distrik   = $request->nama_distrik;
        $data->keterangan   = $request->keterangan;
        $data->geojson   = $request->geojson;

        $data->update();
        alert()->success('Berhasil', 'Ubah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.distrik');
    }


    public function destroy(string $id)
    {
        $data = Distrik::find($id);
        $data->delete();
        return redirect()->back();
    }







}
