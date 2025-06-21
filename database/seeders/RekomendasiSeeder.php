<?php

namespace Database\Seeders;

use App\Models\Rekomendasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekomendasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keluhan = Rekomendasi::create([
            'strategi_id' => '1',
            'kode_distrik' => 'A11',
        ]);

         $keluhan = Rekomendasi::create([
            'strategi_id' => '1',
            'kode_distrik' => 'A3',
        ]);


         $keluhan = Rekomendasi::create([
            'strategi_id' => '1',
            'kode_distrik' => 'A13',
        ]);

        $keluhan = Rekomendasi::create([
            'strategi_id' => '1',
            'kode_distrik' => 'A5',
        ]);



          $keluhan = Rekomendasi::create([
            'strategi_id' => '2',
            'kode_distrik' => 'A14',
        ]);


        //Peringkat 6
          $keluhan = Rekomendasi::create([
            'strategi_id' => '3',
            'kode_distrik' => 'A6',
        ]);



        //Peringkat 7
          $keluhan = Rekomendasi::create([
            'strategi_id' => '4',
            'kode_distrik' => 'A17',
        ]);



        //Peringkat 8
          $keluhan = Rekomendasi::create([
            'strategi_id' => '4',
            'kode_distrik' => 'A8',
        ]);



           //Peringkat 10
          $keluhan = Rekomendasi::create([
            'strategi_id' => '4',
            'kode_distrik' => 'A19',
        ]);


           //Peringkat 9
          $keluhan = Rekomendasi::create([
            'strategi_id' => '5',
            'kode_distrik' => 'A16',
        ]);





           //Peringkat 11
          $keluhan = Rekomendasi::create([
            'strategi_id' => '6',
            'kode_distrik' => 'A9',
        ]);


           //Peringkat 15
          $keluhan = Rekomendasi::create([
            'strategi_id' => '6',
            'kode_distrik' => 'A15',
        ]);



            //Peringkat 12
          $keluhan = Rekomendasi::create([
            'strategi_id' => '7',
            'kode_distrik' => 'A18',
        ]);

        //Peringkat 13
          $keluhan = Rekomendasi::create([
            'strategi_id' => '8',
            'kode_distrik' => 'A7',
        ]);

        //Peringkat 14
          $keluhan = Rekomendasi::create([
            'strategi_id' => '9',
            'kode_distrik' => 'A1',
        ]);


        //Peringkat 16
          $keluhan = Rekomendasi::create([
            'strategi_id' => '10',
            'kode_distrik' => 'A4',
        ]);


//Peringkat 17
        $keluhan = Rekomendasi::create([
            'strategi_id' => '11',
            'kode_distrik' => 'A12',
        ]);


        //Peringkat 19
        $keluhan = Rekomendasi::create([
            'strategi_id' => '11',
            'kode_distrik' => 'A2',
        ]);


         //Peringkat 18
        $keluhan = Rekomendasi::create([
            'strategi_id' => '12',
            'kode_distrik' => 'A10',
        ]);














    }
}
