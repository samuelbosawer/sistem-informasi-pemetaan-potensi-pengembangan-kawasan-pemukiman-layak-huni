<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisKriteria;

class JenisKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = JenisKriteria::create([
            "kriteria" => "a",
            "nilai" => "a",
            "jenis_kriteria" => "a",
            "total_nilai" => "a",
        ]);


        $kriteria = JenisKriteria::create([
            "kriteria" => "b",
            "nilai" => "b",
            "jenis_kriteria" => "b",
            "total_nilai" => "b",
        ]);
    }
}
