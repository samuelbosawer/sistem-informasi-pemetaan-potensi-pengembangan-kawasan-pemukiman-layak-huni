<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisKriteria;

class JenisKriteriaController extends Controller
{
    public function index(Request $request)
    {
        $datas = JenisKriteria::where([
            ['kriteria', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('kriteria', 'LIKE', '%' . $s . '%')
                    ->orWhere('kode_kriteria', 'LIKE', '%' . $s . '%')
                    ->orWhere('skor', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->orderBy('id', 'asc')->paginate(10);
        return view('admin.jenis-kriteria.index',compact('datas'))->with('i',(request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin.jenis-kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'kriteria' => 'required',
                'skor' => 'required|numeric',
                'kode_kriteria' => 'required',
            ],
            [
                'kriteria.required' => 'Tidak boleh kosong',
                'skor.required' => 'Tidak boleh kosong',
                'skor.numeric' => 'Tidak boleh huruf',
                'kode_kriteria.required' => 'Tidak boleh kosong',
                // 'geojson.json' => 'Harus format json',
            ]
        );
        $data = new JenisKriteria();

        $data->kriteria   = $request->kriteria;
        $data->skor   = $request->skor;
        $data->kode_kriteria   = $request->kode_kriteria;

        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.jenis-kriteria');
    }

    public function show(string $id)
    {
        $judul = 'Detail Data Jenis Kriteria';
        $data = JenisKriteria::where('id',$id)->first();
        return view('admin.jenis-kriteria.create', compact('data','judul'));
    }


    public function edit(string $id)
    {
        $judul = 'Ubah Data Jenis Kriteria';
        $data = JenisKriteria::where('id',$id)->first();
        return view('admin.jenis-kriteria.create', compact('data','judul'));
    }

    public function update(Request $request, string $id)
    {
       $request->validate(
            [
                'kriteria' => 'required',
                'skor' => 'required|numeric',
                'kode_kriteria' => 'required',
            ],
            [
                'kriteria.required' => 'Tidak boleh kosong',
                'skor.required' => 'Tidak boleh kosong',
                'skor.numeric' => 'Tidak boleh huruf',
                'kode_kriteria.required' => 'Tidak boleh kosong',
                // 'geojson.json' => 'Harus format json',
            ]
        );
        $data = JenisKriteria::find($id);
        $data->kriteria   = $request->kriteria;
        $data->skor   = $request->skor;
        $data->kode_kriteria   = $request->kode_kriteria;

        $data->update();
        alert()->success('Berhasil', 'Ubah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.jenis-kriteria');

    }


    public function destroy(string $id)
    {
        $data = JenisKriteria::find($id);
        $data->delete();
        return redirect()->back();
    }
}
