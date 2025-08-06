<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $data = [
            // Contoh entri awal, silakan lanjutkan hingga total 494 entri
            ['kode_distrik' => 'A1',  'kode_kriteria' => 'C1', 'nilai' => '5'],
            ['kode_distrik' => 'A2',  'kode_kriteria' => 'C1', 'nilai' => '5'],
            ['kode_distrik' => 'A3',  'kode_kriteria' => 'C1', 'nilai' => '5'],
            ['kode_distrik' => 'A4',  'kode_kriteria' => 'C1', 'nilai' => '4'],
            ['kode_distrik' => 'A5',  'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A6',  'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A7',  'kode_kriteria' => 'C1', 'nilai' => '4'],
            ['kode_distrik' => 'A8',  'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A9',  'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A10', 'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A11', 'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A12', 'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A13', 'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A14', 'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A15', 'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A16', 'kode_kriteria' => 'C1', 'nilai' => '2'],
            ['kode_distrik' => 'A17', 'kode_kriteria' => 'C1', 'nilai' => '3'],
            ['kode_distrik' => 'A18', 'kode_kriteria' => 'C1', 'nilai' => '3'],
            ['kode_distrik' => 'A19', 'kode_kriteria' => 'C1', 'nilai' => '4'],


            ['kode_distrik' => 'A1',  'kode_kriteria' => 'C2', 'nilai' => '5'],
            ['kode_distrik' => 'A2',  'kode_kriteria' => 'C2', 'nilai' => '4'],
            ['kode_distrik' => 'A3',  'kode_kriteria' => 'C2', 'nilai' => '4'],
            ['kode_distrik' => 'A4',  'kode_kriteria' => 'C2', 'nilai' => '3'],
            ['kode_distrik' => 'A5',  'kode_kriteria' => 'C2', 'nilai' => '3'],
            ['kode_distrik' => 'A6',  'kode_kriteria' => 'C2', 'nilai' => '5'],
            ['kode_distrik' => 'A7',  'kode_kriteria' => 'C2', 'nilai' => '4'],
            ['kode_distrik' => 'A8',  'kode_kriteria' => 'C2', 'nilai' => '2'],
            ['kode_distrik' => 'A9',  'kode_kriteria' => 'C2', 'nilai' => '2'],
            ['kode_distrik' => 'A10', 'kode_kriteria' => 'C2', 'nilai' => '2'],
            ['kode_distrik' => 'A11', 'kode_kriteria' => 'C2', 'nilai' => '3'],
            ['kode_distrik' => 'A12', 'kode_kriteria' => 'C2', 'nilai' => '2'],
            ['kode_distrik' => 'A13', 'kode_kriteria' => 'C2', 'nilai' => '2'],
            ['kode_distrik' => 'A14', 'kode_kriteria' => 'C2', 'nilai' => '5'],
            ['kode_distrik' => 'A15', 'kode_kriteria' => 'C2', 'nilai' => '2'],
            ['kode_distrik' => 'A16', 'kode_kriteria' => 'C2', 'nilai' => '4'],
            ['kode_distrik' => 'A17', 'kode_kriteria' => 'C2', 'nilai' => '5'],
            ['kode_distrik' => 'A18', 'kode_kriteria' => 'C2', 'nilai' => '4'],
            ['kode_distrik' => 'A19', 'kode_kriteria' => 'C2', 'nilai' => '2'],



            ['kode_distrik' => 'A1',  'kode_kriteria' => 'C4', 'nilai' => '5'],
            ['kode_distrik' => 'A2',  'kode_kriteria' => 'C4', 'nilai' => '3'],
            ['kode_distrik' => 'A3',  'kode_kriteria' => 'C4', 'nilai' => '4'],
            ['kode_distrik' => 'A4',  'kode_kriteria' => 'C4', 'nilai' => '3'],
            ['kode_distrik' => 'A5',  'kode_kriteria' => 'C4', 'nilai' => '3'],
            ['kode_distrik' => 'A6',  'kode_kriteria' => 'C4', 'nilai' => '4'],
            ['kode_distrik' => 'A7',  'kode_kriteria' => 'C4', 'nilai' => '4'],
            ['kode_distrik' => 'A8',  'kode_kriteria' => 'C4', 'nilai' => '3'],
            ['kode_distrik' => 'A9',  'kode_kriteria' => 'C4', 'nilai' => '2'],
            ['kode_distrik' => 'A10', 'kode_kriteria' => 'C4', 'nilai' => '1'],
            ['kode_distrik' => 'A11', 'kode_kriteria' => 'C4', 'nilai' => '4'],
            ['kode_distrik' => 'A12', 'kode_kriteria' => 'C4', 'nilai' => '2'],
            ['kode_distrik' => 'A13', 'kode_kriteria' => 'C4', 'nilai' => '2'],
            ['kode_distrik' => 'A14', 'kode_kriteria' => 'C4', 'nilai' => '4'],
            ['kode_distrik' => 'A15', 'kode_kriteria' => 'C4', 'nilai' => '3'],
            ['kode_distrik' => 'A16', 'kode_kriteria' => 'C4', 'nilai' => '5'],
            ['kode_distrik' => 'A17', 'kode_kriteria' => 'C4', 'nilai' => '2'],
            ['kode_distrik' => 'A18', 'kode_kriteria' => 'C4', 'nilai' => '3'],
            ['kode_distrik' => 'A19', 'kode_kriteria' => 'C4', 'nilai' => '3'],




            ['kode_distrik' => 'A1',  'kode_kriteria' => 'C5', 'nilai' => '5'],
    ['kode_distrik' => 'A2',  'kode_kriteria' => 'C5', 'nilai' => '4'],
    ['kode_distrik' => 'A3',  'kode_kriteria' => 'C5', 'nilai' => '4'],
    ['kode_distrik' => 'A4',  'kode_kriteria' => 'C5', 'nilai' => '3'],
    ['kode_distrik' => 'A5',  'kode_kriteria' => 'C5', 'nilai' => '3'],
    ['kode_distrik' => 'A6',  'kode_kriteria' => 'C5', 'nilai' => '4'],
    ['kode_distrik' => 'A7',  'kode_kriteria' => 'C5', 'nilai' => '4'],
    ['kode_distrik' => 'A8',  'kode_kriteria' => 'C5', 'nilai' => '4'],
    ['kode_distrik' => 'A9',  'kode_kriteria' => 'C5', 'nilai' => '2'],
    ['kode_distrik' => 'A10', 'kode_kriteria' => 'C5', 'nilai' => '1'],
    ['kode_distrik' => 'A11', 'kode_kriteria' => 'C5', 'nilai' => '3'],
    ['kode_distrik' => 'A12', 'kode_kriteria' => 'C5', 'nilai' => '2'],
    ['kode_distrik' => 'A13', 'kode_kriteria' => 'C5', 'nilai' => '3'],
    ['kode_distrik' => 'A14', 'kode_kriteria' => 'C5', 'nilai' => '4'],
    ['kode_distrik' => 'A15', 'kode_kriteria' => 'C5', 'nilai' => '2'],
    ['kode_distrik' => 'A16', 'kode_kriteria' => 'C5', 'nilai' => '5'],
    ['kode_distrik' => 'A17', 'kode_kriteria' => 'C5', 'nilai' => '2'],
    ['kode_distrik' => 'A18', 'kode_kriteria' => 'C5', 'nilai' => '4'],
    ['kode_distrik' => 'A19', 'kode_kriteria' => 'C5', 'nilai' => '4'],

   ['kode_distrik' => 'A1',  'kode_kriteria' => 'C6', 'nilai' => '5'],
    ['kode_distrik' => 'A2',  'kode_kriteria' => 'C6', 'nilai' => '3'],
    ['kode_distrik' => 'A3',  'kode_kriteria' => 'C6', 'nilai' => '4'],
    ['kode_distrik' => 'A4',  'kode_kriteria' => 'C6', 'nilai' => '4'],
    ['kode_distrik' => 'A5',  'kode_kriteria' => 'C6', 'nilai' => '3'],
    ['kode_distrik' => 'A6',  'kode_kriteria' => 'C6', 'nilai' => '3'],
    ['kode_distrik' => 'A7',  'kode_kriteria' => 'C6', 'nilai' => '4'],
    ['kode_distrik' => 'A8',  'kode_kriteria' => 'C6', 'nilai' => '5'],
    ['kode_distrik' => 'A9',  'kode_kriteria' => 'C6', 'nilai' => '2'],
    ['kode_distrik' => 'A10', 'kode_kriteria' => 'C6', 'nilai' => '2'],
    ['kode_distrik' => 'A11', 'kode_kriteria' => 'C6', 'nilai' => '2'],
    ['kode_distrik' => 'A12', 'kode_kriteria' => 'C6', 'nilai' => '1'],
    ['kode_distrik' => 'A13', 'kode_kriteria' => 'C6', 'nilai' => '3'],
    ['kode_distrik' => 'A14', 'kode_kriteria' => 'C6', 'nilai' => '3'],
    ['kode_distrik' => 'A15', 'kode_kriteria' => 'C6', 'nilai' => '3'],
    ['kode_distrik' => 'A16', 'kode_kriteria' => 'C6', 'nilai' => '4'],
    ['kode_distrik' => 'A17', 'kode_kriteria' => 'C6', 'nilai' => '3'],
    ['kode_distrik' => 'A18', 'kode_kriteria' => 'C6', 'nilai' => '3'],
    ['kode_distrik' => 'A19', 'kode_kriteria' => 'C6', 'nilai' => '2'],


            ['kode_distrik' => 'A1',  'kode_kriteria' => 'C12', 'nilai' => 4],
    ['kode_distrik' => 'A2',  'kode_kriteria' => 'C12', 'nilai' => 2],
    ['kode_distrik' => 'A3',  'kode_kriteria' => 'C12', 'nilai' => 4],
    ['kode_distrik' => 'A4',  'kode_kriteria' => 'C12', 'nilai' => 3],
    ['kode_distrik' => 'A5',  'kode_kriteria' => 'C12', 'nilai' => 3],
    ['kode_distrik' => 'A6',  'kode_kriteria' => 'C12', 'nilai' => 3],
    ['kode_distrik' => 'A7',  'kode_kriteria' => 'C12', 'nilai' => 3],
    ['kode_distrik' => 'A8',  'kode_kriteria' => 'C12', 'nilai' => 5],
    ['kode_distrik' => 'A9',  'kode_kriteria' => 'C12', 'nilai' => 4],
    ['kode_distrik' => 'A10', 'kode_kriteria' => 'C12', 'nilai' => 2],
    ['kode_distrik' => 'A11', 'kode_kriteria' => 'C12', 'nilai' => 3],
    ['kode_distrik' => 'A12', 'kode_kriteria' => 'C12', 'nilai' => 1],
    ['kode_distrik' => 'A13', 'kode_kriteria' => 'C12', 'nilai' => 2],
    ['kode_distrik' => 'A14', 'kode_kriteria' => 'C12', 'nilai' => 3],
    ['kode_distrik' => 'A15', 'kode_kriteria' => 'C12', 'nilai' => 2],
    ['kode_distrik' => 'A16', 'kode_kriteria' => 'C12', 'nilai' => 2],
    ['kode_distrik' => 'A17', 'kode_kriteria' => 'C12', 'nilai' => 4],
    ['kode_distrik' => 'A18', 'kode_kriteria' => 'C12', 'nilai' => 1],
    ['kode_distrik' => 'A19', 'kode_kriteria' => 'C12', 'nilai' => 2],



            ['kode_distrik' => 'A1',  'kode_kriteria' => 'C15', 'nilai' => '3'],
            ['kode_distrik' => 'A2',  'kode_kriteria' => 'C15', 'nilai' => '4'],
            ['kode_distrik' => 'A3',  'kode_kriteria' => 'C15', 'nilai' => '4'],
            ['kode_distrik' => 'A4',  'kode_kriteria' => 'C15', 'nilai' => '5'],
            ['kode_distrik' => 'A5',  'kode_kriteria' => 'C15', 'nilai' => '5'],
            ['kode_distrik' => 'A6',  'kode_kriteria' => 'C15', 'nilai' => '2'],
            ['kode_distrik' => 'A7',  'kode_kriteria' => 'C15', 'nilai' => '5'],
            ['kode_distrik' => 'A8',  'kode_kriteria' => 'C15', 'nilai' => '3'],
            ['kode_distrik' => 'A9',  'kode_kriteria' => 'C15', 'nilai' => '4'],
            ['kode_distrik' => 'A10', 'kode_kriteria' => 'C15', 'nilai' => '3'],
            ['kode_distrik' => 'A11', 'kode_kriteria' => 'C15', 'nilai' => '2'],
            ['kode_distrik' => 'A12', 'kode_kriteria' => 'C15', 'nilai' => '2'],
            ['kode_distrik' => 'A13', 'kode_kriteria' => 'C15', 'nilai' => '2'],
            ['kode_distrik' => 'A14', 'kode_kriteria' => 'C15', 'nilai' => '2'],
            ['kode_distrik' => 'A15', 'kode_kriteria' => 'C15', 'nilai' => '2'],
            ['kode_distrik' => 'A16', 'kode_kriteria' => 'C15', 'nilai' => '3'],
            ['kode_distrik' => 'A17', 'kode_kriteria' => 'C15', 'nilai' => '4'],
            ['kode_distrik' => 'A18', 'kode_kriteria' => 'C15', 'nilai' => '3'],
            ['kode_distrik' => 'A19', 'kode_kriteria' => 'C15', 'nilai' => '3'],



            ['kode_distrik' => 'A1',  'kode_kriteria' => 'C16', 'nilai' => 4],
            ['kode_distrik' => 'A2',  'kode_kriteria' => 'C16', 'nilai' => 4],
            ['kode_distrik' => 'A3',  'kode_kriteria' => 'C16', 'nilai' => 4],
            ['kode_distrik' => 'A4',  'kode_kriteria' => 'C16', 'nilai' => 5],
            ['kode_distrik' => 'A5',  'kode_kriteria' => 'C16', 'nilai' => 4],
            ['kode_distrik' => 'A6',  'kode_kriteria' => 'C16', 'nilai' => 3],
            ['kode_distrik' => 'A7',  'kode_kriteria' => 'C16', 'nilai' => 5],
            ['kode_distrik' => 'A8',  'kode_kriteria' => 'C16', 'nilai' => 2],
            ['kode_distrik' => 'A9',  'kode_kriteria' => 'C16', 'nilai' => 3],
            ['kode_distrik' => 'A10', 'kode_kriteria' => 'C16', 'nilai' => 2],
            ['kode_distrik' => 'A11', 'kode_kriteria' => 'C16', 'nilai' => 3],
            ['kode_distrik' => 'A12', 'kode_kriteria' => 'C16', 'nilai' => 2],
            ['kode_distrik' => 'A13', 'kode_kriteria' => 'C16', 'nilai' => 2],
            ['kode_distrik' => 'A14', 'kode_kriteria' => 'C16', 'nilai' => 4],
            ['kode_distrik' => 'A15', 'kode_kriteria' => 'C16', 'nilai' => 2],
            ['kode_distrik' => 'A16', 'kode_kriteria' => 'C16', 'nilai' => 2],
            ['kode_distrik' => 'A17', 'kode_kriteria' => 'C16', 'nilai' => 4],
            ['kode_distrik' => 'A18', 'kode_kriteria' => 'C16', 'nilai' => 4],
            ['kode_distrik' => 'A19', 'kode_kriteria' => 'C16', 'nilai' => 1],




            ['kode_distrik' => 'A1',  'kode_kriteria' => 'C19', 'nilai' => 4],
            ['kode_distrik' => 'A2',  'kode_kriteria' => 'C19', 'nilai' => 5],
            ['kode_distrik' => 'A3',  'kode_kriteria' => 'C19', 'nilai' => 5],
            ['kode_distrik' => 'A4',  'kode_kriteria' => 'C19', 'nilai' => 4],
            ['kode_distrik' => 'A5',  'kode_kriteria' => 'C19', 'nilai' => 4],
            ['kode_distrik' => 'A6',  'kode_kriteria' => 'C19', 'nilai' => 3],
            ['kode_distrik' => 'A7',  'kode_kriteria' => 'C19', 'nilai' => 2],
            ['kode_distrik' => 'A8',  'kode_kriteria' => 'C19', 'nilai' => 2],
            ['kode_distrik' => 'A9',  'kode_kriteria' => 'C19', 'nilai' => 3],
            ['kode_distrik' => 'A10', 'kode_kriteria' => 'C19', 'nilai' => 2],
            ['kode_distrik' => 'A11', 'kode_kriteria' => 'C19', 'nilai' => 2],
            ['kode_distrik' => 'A12', 'kode_kriteria' => 'C19', 'nilai' => 3],
            ['kode_distrik' => 'A13', 'kode_kriteria' => 'C19', 'nilai' => 2],
            ['kode_distrik' => 'A14', 'kode_kriteria' => 'C19', 'nilai' => 3],
            ['kode_distrik' => 'A15', 'kode_kriteria' => 'C19', 'nilai' => 2],
            ['kode_distrik' => 'A16', 'kode_kriteria' => 'C19', 'nilai' => 2],
            ['kode_distrik' => 'A17', 'kode_kriteria' => 'C19', 'nilai' => 4],
            ['kode_distrik' => 'A18', 'kode_kriteria' => 'C19', 'nilai' => 5],
            ['kode_distrik' => 'A19', 'kode_kriteria' => 'C19', 'nilai' => 1],


        ];
        DB::table('topses')->insert($data);
    }
}
