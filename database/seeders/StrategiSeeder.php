<?php

namespace Database\Seeders;

use App\Models\KriteriaStrategi;
use App\Models\Strategi;
use Illuminate\Database\Seeder;

class StrategiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


         $strategies = [

            // Strategi dari peringkat 1 - 4

             [
                'tipe' => 'SO',
                'strategi_satu' => '6',
                'strategi_dua' => '7',
                'strategi_tiga' => '17',
                'strategi_empat' => '15',
            ],


            // Strategi dari peringkat 5
            //    S5, S4, S3, O3
            [
                'tipe' => 'SO',
                'strategi_satu' => '5',
                'strategi_dua' => '4',
                'strategi_tiga' => '3',
                'strategi_empat' => '17',
            ],

            // Strategi dari peringkat 6
            //    S5, S4, S3, O3
            [
                'tipe' => 'SO',
                'strategi_satu' => '6',
                'strategi_dua' => '7',
                'strategi_tiga' => null,
                'strategi_empat' => null,
            ],


            // Strategi dari peringkat 7 -8, 10
            [
                'tipe' => 'SO',
                'strategi_satu' => '2',
                'strategi_dua' => '25',
                'strategi_tiga' => null,
                'strategi_empat' => null,
            ],

          // Strategi dari peringkat 9
             [
                'tipe' => 'SO',
                'strategi_satu' => '1',
                'strategi_dua' => '21',
                'strategi_tiga' => '22',
                'strategi_empat' => '23',
            ],


             // Strategi dari peringkat 11, 15
            //  W1, W4, O4
             [
                'tipe' => 'SO',
                'strategi_satu' => '8',
                'strategi_dua' => '11',
                'strategi_tiga' => '18',
                'strategi_empat' => null ,
            ],


            // Strategi dari peringkat 12
            // W2, W7, O5,O6
             [
                'tipe' => 'SO',
                'strategi_satu' => '9',
                'strategi_dua' => '14',
                'strategi_tiga' => '19',
                'strategi_empat' => '20' ,
            ],


            // Strategi dari peringkat 13
            // W3, O1, O3
             [
                'tipe' => 'SO',
                'strategi_satu' => '10',
                'strategi_dua' => '15',
                'strategi_tiga' => '17',
                'strategi_empat' => null ,
            ],


              // Strategi dari peringkat 14
              //   W5, O1
             [
                'tipe' => 'SO',
                'strategi_satu' => '12',
                'strategi_dua' => '15',
                'strategi_tiga' => null,
                'strategi_empat' => null ,
            ],

             // Strategi dari peringkat 16
              //   W4, W6, T1
             [
                'tipe' => 'SO',
                'strategi_satu' => '11',
                'strategi_dua' => '13',
                'strategi_tiga' => '21',
                'strategi_empat' => null ,
            ],


               // Strategi dari peringkat 17, 19
              //   W1,W2,T4
             [
                'tipe' => 'SO',
                'strategi_satu' => '8',
                'strategi_dua' => '9',
                'strategi_tiga' => '24',
                'strategi_empat' => null ,
            ],


               // Strategi dari peringkat 18
              //   W7, W3, T5
             [
                'tipe' => 'SO',
                'strategi_satu' => '14',
                'strategi_dua' => '10',
                'strategi_tiga' => '25',
                'strategi_empat' => null ,
            ],









        ];


        foreach ($strategies as $s) {
            $strategy = Strategi::create([
                'tipe' => $s['tipe'],
                'strategi_satu' => $s['strategi_satu'],
                'strategi_dua' => $s['strategi_dua'],
                'strategi_tiga' => $s['strategi_tiga'],
                'strategi_empat' => $s['strategi_empat'],
            ]);

            //  Attach ke tabel pivot kriteria_strategis
            // if (!empty($s['strategi_id'])) {
            //     $strategy->kriteriaStrategis()->attach($s['strategi_id']);
            // }
        }
    }
}
