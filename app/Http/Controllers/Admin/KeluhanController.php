<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distrik;
use App\Models\Keluhan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class KeluhanController extends Controller
{
    public function index(Request $request)
    {
        $query = Keluhan::with('distrik')
            ->whereNotNull('keluhan');

        if (Auth::user()->hasRole('investor')) {
            $query->where('user_id', Auth::user()->id);
        }

        if ($s = $request->s) {
            $query->where(function ($q) use ($s) {
                $q->where('keluhan', 'LIKE', '%' . $s . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $s . '%')
                    ->orWhereHas('distrik', function ($q2) use ($s) {
                        $q2->where('nama_distrik', 'LIKE', '%' . $s . '%');
                    });
            });
        }

        $datas = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.keluhan.index', compact('datas'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function pdf(Request $request)
    {

        $query = Keluhan::with('distrik')
            ->whereNotNull('keluhan');

        if (Auth::user()->hasRole('investor')) {
            $query->where('user_id', Auth::user()->id);
        }

        if ($s = $request->s) {
            $query->where(function ($q) use ($s) {
                $q->where('keluhan', 'LIKE', '%' . $s . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $s . '%')
                    ->orWhereHas('distrik', function ($q2) use ($s) {
                        $q2->where('nama_distrik', 'LIKE', '%' . $s . '%');
                    });
            });
        }

        $datas = $query->orderBy('id', 'desc')->get();

        $title = 'Laporan Keluhan';

        $data = [
            'title' => $title,
            'datas' => $datas
        ];
        $pdf = Pdf::loadView('admin.keluhan.pdf', $data);
        return $pdf->stream('laporan-keluhan.pdf');
    }

    public function create()
    {

        $distriks = Distrik::get();
        return view('admin.keluhan.create', compact('distriks'));
    }

    public function store(Request $request)
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
        $data = new Keluhan();

        $data->keluhan   = $request->keluhan;
        $data->tanggal   = $request->tanggal;
        $data->latitude   = $request->latitude;
        $data->longitude   = $request->longitude;
        $data->user_id   = Auth::user()->id;
        $data->distrik_id   = $request->distrik_id;
        $data->status   = 'Draft';


        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fileName = time() . '-' . $foto->getClientOriginalName(); // pakai time() biar ringkas
            $uploadPath = public_path('foto/keluhan');
            $fullPath = $uploadPath . '/' . $fileName;

            // Hapus file lama jika ada
            if (!empty($data->foto) && File::exists(public_path($data->foto))) {
                File::delete(public_path($data->foto));
            }

            // Pindahkan file baru
            $foto->move($uploadPath, $fileName);

            // Simpan nama file baru ke dalam database
            $data->foto = 'foto/keluhan/' . $fileName;
        }

        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('dashboard.keluhan');
    }

    public function show(string $id)
    {

        $data = Keluhan::where('id', $id)->first();
        $judul = 'Detail Data Keluhan';
        $distriks = Distrik::get();
        return view('admin.keluhan.create', compact('data', 'judul', 'distriks'));
    }


    public function edit(string $id)
    {
        $data = Keluhan::where('id', $id)->first();
        $judul = 'Ubah Data Keluhan';
        $distriks = Distrik::get();
        return view('admin.keluhan.create', compact('data', 'judul', 'distriks'));
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
        $data->latitude   = $request->latitude;
        $data->longitude   = $request->longitude;
        $data->distrik_id   = $request->distrik_id;
        $data->status   =  $request->status;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fileName = time() . '-' . $foto->getClientOriginalName(); // pakai time() biar ringkas
            $uploadPath = public_path('foto/keluhan');
            $fullPath = $uploadPath . '/' . $fileName;

            // Hapus file lama jika ada
            if (!empty($data->foto) && File::exists(public_path($data->foto))) {
                File::delete(public_path($data->foto));
            }

            // Pindahkan file baru
            $foto->move($uploadPath, $fileName);

            // Simpan nama file baru ke dalam database
            $data->foto = 'foto/keluhan/' . $fileName;
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
