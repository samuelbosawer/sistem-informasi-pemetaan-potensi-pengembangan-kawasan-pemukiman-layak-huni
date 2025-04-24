<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // $table->string('rating')->nullable();
        //     $table->string('bobot')->nullable();
        //     $table->string('skor')->nullable();
        //     $table->string('total_nilai_faktor')->nullable();
        //     $table->bigInteger('jenis_kategorias_id')->nullable();
        $kriteria = Kriteria::create([
            'rating' => '12',
            'bobot' => '12',
            'skor' => '12',
            'total_nilai_faktor' => '12',
            'jenis_kriteria_id' => '1',
        ]);

        $kriteria = Kriteria::create([
            'rating' => '12',
            'bobot' => '12',
            'skor' => '12',
            'total_nilai_faktor' => '12',
            'jenis_kriteria_id' => '2',
        ]);
    }


}
