<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //     $table->string('nama');
    //     $table->string('alamat');
    //     $table->string('no_hp');
    //     $table->string('email')->unique();
    //     $table->string('password');
    //     $table->string('jenis_kelamin');
    //     // $table->timestamp('

        $user = User::create([
            'nama' => 'Admin',
            'alamat' => 'Sentani',
            'no_hp' => '082198159714',
            'email' => 'admin@master.com',
            'password' =>  bcrypt('admin@master.com'),
            'jenis_kelamin' => '',

        ]);
        $user->assignRole('admin');



        $user = User::create([
            'nama' => 'Bepala Bidang',
            'alamat' => 'Sentani',
            'no_hp' => '082198159711',
            'email' => 'kepala@master.com',
            'password' =>  bcrypt('kepala@master.com'),
            'jenis_kelamin' => '',

        ]);
        $user->assignRole('kepalaBidang');


        $user = User::create([
            'nama' => 'Samuel Septer',
            'alamat' => 'Sentani',
            'no_hp' => '082198159721',
            'email' => 'samuel@gmail.com',
            'password' =>  bcrypt('samuel@gmail.com'),
            'jenis_kelamin' => '',

        ]);
        $user->assignRole('investor');
    }
}
