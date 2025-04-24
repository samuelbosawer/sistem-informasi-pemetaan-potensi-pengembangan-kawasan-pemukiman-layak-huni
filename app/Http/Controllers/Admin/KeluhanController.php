<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class KeluhanController extends Controller
{
    public function index(Request $request)
    {
        $datas = Keluhan::where([
            ['keluhan', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('keluhan', 'LIKE', '%' . $s . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->orderBy('id', 'desc')->paginate(10);
        return view('admin.keluhan.index',compact('datas'))->with('i',(request()->input('page', 1) - 1) * 10);

    }

    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'investor');
        })->get();
        return view('admin.keluhan.create',compact('users'));
    }

    public function store(Request $request)
    {
      // $table->string('keluhan')->nullable();
        // $table->date('tanggal')->nullable();
        // $table->string('foto')->nullable();
        // $table->bigInteger('')->nullable();

        $request->validate(
            [
                'keluhan' => 'required',
               'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ],
            [
                'keluhan.required' => 'Tidak boleh kosong',
                // 'geojson.json' => 'Harus format json',
            ]
        );
        $data = new Keluhan();

        $data->keluhan   = $request->keluhan;
        $data->tanggal   = $request->tanggal;
        $data->user_id   = $request->user_id;

        if (isset($request->foto)) {
            $fileName = $request->foto->getClientOriginalName();
            $path = public_path('foto/keluhan/'.Auth::User()->id.'/'. $data->foto);
            if (file_exists($path)) {
                File::delete($path);
            }
            $timestamp = now()->timestamp;
            $data->foto = 'foto/keluhan/'.Auth::User()->id.'/'.$timestamp.'-'.$fileName;
            $request->foto->move(public_path('foto/keluhan/').Auth::User()->id. '/', $timestamp.'-'.$fileName);
        }

        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.keluhan');

    }

    public function show(string $id)
    {

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'investor');
        })->get();
        $data = Keluhan::where('id',$id)->first();
        $judul = 'Detail Data Keluhan';
        return view('admin.keluhan.create',compact('users','data','judul'));

    }


    public function edit(string $id)
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'investor');
        })->get();
        $data = Keluhan::where('id',$id)->first();
        $judul = 'Ubah Data Keluhan';
        return view('admin.keluhan.create',compact('users','data','judul'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'keluhan' => 'required',
               'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ],
            [
                'keluhan.required' => 'Tidak boleh kosong',
                // 'geojson.json' => 'Harus format json',
            ]
        );
        $data =  Keluhan::find($id);

        $data->keluhan   = $request->keluhan;
        $data->tanggal   = $request->tanggal;
        $data->user_id   = $request->user_id;

        if (isset($request->foto)) {
            $fileName = $request->foto->getClientOriginalName();
            $path = public_path('foto/keluhan/'.Auth::User()->id.'/'. $data->foto);
            if (file_exists($path)) {
                File::delete($path);
            }
            $timestamp = now()->timestamp;
            $data->foto = 'foto/keluhan/'.Auth::User()->id.'/'.$timestamp.'-'.$fileName;
            $request->foto->move(public_path('foto/keluhan/').Auth::User()->id. '/', $timestamp.'-'.$fileName);
        }

        $data->update();
        alert()->success('Berhasil', 'Ubah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.keluhan');
    }


    public function destroy(string $id)
    {
        $data = Keluhan::find($id);
        if ($data->foto) {
            File::delete($data->foto);
        }
        $data->delete();
        return redirect()->back();
    }
}
