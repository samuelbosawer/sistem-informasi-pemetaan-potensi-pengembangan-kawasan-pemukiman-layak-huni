<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        $datas = Kriteria::where([
            ['rating', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('rating', 'LIKE', '%' . $s . '%')
                    ->orWhere('bobot', 'LIKE', '%' . $s . '%')
                    ->orWhere('skor', 'LIKE', '%' . $s . '%')
                    ->orWhere('total_nilai_faktor', 'LIKE', '%' . $s . '%')
                     ->get();
                }
            }]
        ])->orderBy('id', 'desc')->paginate(10);
        return view('admin.kriteria.index',compact('datas'))->with('i',(request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $kriteria = JenisKriteria::get();
        return view('admin.kriteria.create',compact('kriteria'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'rating' => 'required',
                'skor' => 'required',
            ],
            [
                'skor.required' => 'Tidak boleh kosong',
                'rating.required' => 'Tidak boleh kosong',
                // 'geojson.json' => 'Harus format json',
            ]
        );
        $data = new Kriteria();

        $data->rating   = $request->rating;
        $data->bobot   = $request->bobot;
        $data->skor   = $request->skor;
        $data->total_nilai_faktor   = $request->total_nilai_faktor;
        $data->jenis_kriteria_id   = $request->jenis_kriteria_id;

        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.kriteria');

    }

    public function show(string $id)
    {
        $judul = 'Detail Data Kriteria';
        $data = Kriteria::where('id',$id)->first();
        $kriteria = JenisKriteria::get();
        return view('admin.kriteria.create', compact('data','judul','kriteria'));
    }


    public function edit(string $id)
    {
        $judul = 'Ubah Data Kriteria';
        $data = Kriteria::where('id',$id)->first();
        $kriteria = JenisKriteria::get();
        return view('admin.kriteria.create', compact('data','judul','kriteria'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'rating' => 'required',
                'skor' => 'required',
            ],
            [
                'skor.required' => 'Tidak boleh kosong',
                'rating.required' => 'Tidak boleh kosong',
                // 'geojson.json' => 'Harus format json',
            ]
        );
        $data = Kriteria::find($id);

        $data->rating   = $request->rating;
        $data->bobot   = $request->bobot;
        $data->skor   = $request->skor;
        $data->total_nilai_faktor   = $request->total_nilai_faktor;
        $data->jenis_kriteria_id   = $request->jenis_kriteria_id;

        $data->update();
        alert()->success('Berhasil', 'Ubah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.kriteria');

    }


    public function destroy(string $id)
    {
        $data = Kriteria::find($id);
        $data->delete();
        return redirect()->back();

    }
}
