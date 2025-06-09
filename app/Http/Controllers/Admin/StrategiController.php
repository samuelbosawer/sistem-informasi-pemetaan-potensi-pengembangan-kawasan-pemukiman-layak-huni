<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKriteria;
use Illuminate\Http\Request;
use App\Models\Strategi;

class StrategiController extends Controller
{
    public function index(Request $request)
    {
        $datas = Strategi::with('satu')->with('dua')->with('tiga')->with('empat')->where([
            ['tipe', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('tipe', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->orderBy('id', 'asc')->paginate(10);

        return view('admin.strategi.index', compact('datas'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $kriteria = JenisKriteria::get();
        return view('admin.strategi.create', compact('kriteria'));
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
        $data->strategi_satu   = $request->strategi_satu;
        $data->strategi_dua   = $request->strategi_dua;
        $data->strategi_tiga   = $request->strategi_tiga;
        $data->strategi_empat   = $request->strategi_empat;
        $data->save();


        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.strategi');
    }

    public function show(string $id)
    {
        $judul = 'Detail Data Strategi';
        $kriteria = JenisKriteria::get();
        $data = Strategi::where('id', $id)->first();
        return view('admin.strategi.create', compact('data', 'judul','kriteria'));
    }


    public function edit(string $id)
    {
        $judul = 'Ubah Data Strategi';
        $kriteria = JenisKriteria::get();
        $data = Strategi::where('id', $id)->first();
        return view('admin.strategi.create', compact('data', 'judul','kriteria'));
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
        $data->strategi_satu   = $request->strategi_satu;
        $data->strategi_dua   = $request->strategi_dua;
        $data->strategi_tiga   = $request->strategi_tiga;
        $data->strategi_empat   = $request->strategi_empat;
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
