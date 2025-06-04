<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Strategi;

class StrategiController extends Controller
{
     public function index(Request $request)
    {
        $datas = Strategi::where([
            ['tipe', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('tipe', 'LIKE', '%' . $s . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->orderBy('id', 'asc')->paginate(10);
        return view('admin.strategi.index',compact('datas'))->with('i',(request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin.strategi.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'tipe' => 'required',
                // 'tipe' => 'required|unique:strategis,tipe|string',
            ],
            [
                'tipe.required' => 'Tidak boleh kosong',
                // 'tipe.unique' => 'Data sudah ada',
            ]
        );

        $data = new Strategi();
        $data->tipe   = $request->tipe;
        $data->keterangan   = $request->keterangan;
        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.strategi');
    }

    public function show(string $id)
    {
        $judul = 'Detail Data Strategi';
        $data = Strategi::where('id',$id)->first();
        return view('admin.strategi.create', compact('data','judul'));
    }


    public function edit(string $id)
    {
        $judul = 'Ubah Data Strategi';
        $data = Strategi::where('id',$id)->first();
        return view('admin.strategi.create', compact('data','judul'));
    }

    public function update(Request $request, string $id)
    {
      $request->validate(
            [
                'tipe' => 'required',
            ],
            [
                'tipe.required' => 'Tidak boleh kosong',
            ]
        );
        $data = Strategi::find($id);
        $data->tipe   = $request->tipe;
        $data->keterangan   = $request->keterangan;
        $data->update();
        alert()->success('Berhasil', 'Ubah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.strategi');

    }


    public function destroy(string $id)
    {
        $data = Strategi::find($id);
        $data->delete();
        return redirect()->back();
    }
}
