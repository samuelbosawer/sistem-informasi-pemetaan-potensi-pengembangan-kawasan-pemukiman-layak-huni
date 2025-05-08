<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('visitor.home.index');
    }

    public function daftar()
    {
        return view('visitor.home.daftar');
    }

    public function daftar_store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                // 'phone' => 'required|unique:users,phone|max:13',
                'email' => 'required|unique:users,email|string',
                // 'date_of_birth' => 'required',
                'password'  => 'required|confirmed|min:8',
                'password_confirmation' => 'required_with:password|same:password|min:8'
            ],
            [
                'email.required' => 'Tidak boleh kosong',
                'email.unique' => 'Email sudah terdaftar',
                'nama.required' => 'Tidak boleh kosong',
                'jenis_kelamin.required' => 'Tidak boleh kosong',
                'password.required' => 'Tidak boleh kosong',
                'password.confirmed' => 'Password tidak sama',
            ]
        );
        $data = new User();

        $data->email   = $request->email;
        $data->nama   = $request->nama;
        $data->jenis_kelamin   = $request->jenis_kelamin;
        $data->password   = $request->password;
        $data->assignRole('');

        $data->save();
        alert()->success('Berhasil', 'Tambah data berhasil')->autoclose(3000);
        return redirect()->route('login');
    }
}
