<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distrik;
use App\Models\Peringkat;
use Illuminate\Http\Request;

class PeringkatController extends Controller
{
    public function index(Request $request)
    {
        $datas = Peringkat::where([
            ['tipe', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('tipe', 'LIKE', '%' . $s . '%')
                    ->orWhere('keterangan', 'LIKE', '%' . $s . '%')
                    ->orWhere('peringkat', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->orderBy('id', 'asc')->paginate(10);
        return view('admin.peringkat.index',compact('datas'))->with('i',(request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $peringkat = Peringkat::select('peringkat')->distinct()->orderBy('peringkat')->pluck('peringkat');
        $distrik = Distrik::get()->count();
        return view('admin.peringkat.create',compact('peringkat','distrik'));
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

        $data = new Peringkat();
        $data->tipe   = $request->tipe;
        $data->keterangan   = $request->keterangan;
        $data->peringkat   = $request->peringkat;
        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.peringkat');
    }

    public function show(string $id)
    {
        $judul = 'Detail Data Strategi';
        $data = Peringkat::where('id',$id)->first();

        return view('admin.peringkat.create', compact('data','judul'));
    }


    public function edit(string $id)
    {
        $judul = 'Ubah Data Strategi';
        $data = Peringkat::where('id',$id)->first();
        return view('admin.peringkat.create', compact('data','judul'));
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
        $data = Peringkat::find($id);
        $data->tipe   = $request->tipe;
        $data->keterangan   = $request->keterangan;
        $data->peringkat   = $request->peringkat;
        $data->update();
        alert()->success('Berhasil', 'Ubah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.peringkat');

    }


    public function destroy(string $id)
    {
        $data = Peringkat::find($id);
        $data->delete();
        return redirect()->back();
    }
}
