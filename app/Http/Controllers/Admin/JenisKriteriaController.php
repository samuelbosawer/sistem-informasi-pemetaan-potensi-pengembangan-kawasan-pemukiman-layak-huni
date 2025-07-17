<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisKriteria;
use App\Models\Topsis;

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
                    ->orWhere('penilaian', 'LIKE', '%' . $s . '%')
                    ->orWhere('rating', 'LIKE', '%' . $s . '%')
                    ->orWhere('faktor', 'LIKE', '%' . $s . '%')
                    ->orWhere('label', 'LIKE', '%' . $s . '%')
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
                'kode_kriteria' => 'required|unique:jenis_kriterias,kode_kriteria',
                'penilaian' => 'required|numeric',
                'rating' => 'required|numeric',
            ],
            [
                'kriteria.required' => 'Tidak boleh kosong',
                'kode_kriteria.required' => 'Tidak boleh kosong',
                'kode_kriteria.unique' => 'Tidak boleh sama',
                'penilaian.required' => 'Tidak boleh kosong',
                'penilaian.numeric' => 'Tidak boleh huruf',
                'rating.required' => 'Tidak boleh kosong',
                'rating.numeric' => 'Tidak boleh huruf',
                // 'geojson.json' => 'Harus format json',
            ]
        );

        $data = new JenisKriteria();

        $data->kriteria   = $request->kriteria;
        $data->kode_kriteria   = $request->kode_kriteria;
        $data->penilaian   = $request->penilaian;
        $data->rating   = $request->rating;
        $data->faktor   = $request->faktor;
        $data->label   = $request->label;

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
                'penilaian' => 'required|numeric',
                'rating' => 'required|numeric',
            ],
            [
                'kriteria.required' => 'Tidak boleh kosong',
                'penilaian.required' => 'Tidak boleh kosong',
                'penilaian.numeric' => 'Tidak boleh huruf',
                'rating.required' => 'Tidak boleh kosong',
                'rating.numeric' => 'Tidak boleh huruf',
                // 'geojson.json' => 'Harus format json',
            ]
        );
        $data = JenisKriteria::find($id);
        $data->kriteria   = $request->kriteria;
        $data->penilaian   = $request->penilaian;
        $data->rating   = $request->rating;
        $data->faktor   = $request->faktor;
        $data->label   = $request->label;

        $data->update();
        alert()->success('Berhasil', 'Ubah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.jenis-kriteria');

    }


    public function destroy(string $id)
    {
        $data = JenisKriteria::find($id);
        $topsis = Topsis::where('kode_kriteria',$data->kode_kriteria)->delete();
        $data->delete();
        return redirect()->back();
    }
}
