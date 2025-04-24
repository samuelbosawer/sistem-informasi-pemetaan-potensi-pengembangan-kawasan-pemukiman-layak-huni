<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Keluhan;
use Carbon\Carbon;

class KeluhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $table->string('keluhan')->nullable();
        // $table->date('tanggal')->nullable();
        // $table->string('foto')->nullable();
        // $table->bigInteger('user_id')->nullable();

        $keluhan = Keluhan::create([
            'keluhan' => 'Tanah Rawa',
            'tanggal' => Carbon::create(2025, 4, 12),
            'foto' => null,
            'user_id' => 3
        ]);


        $keluhan = Keluhan::create([
            'keluhan' => 'Tanah Adat',
            'tanggal' => Carbon::create(2025, 4, 12),
            'foto' => null,
            'user_id' => 3
        ]);



        $keluhan = Keluhan::create([
            'keluhan' => 'Tidak ada pelepasan tanah',
            'tanggal' => Carbon::create(2025, 4, 12),
            'foto' => null,
            'user_id' => 3
        ]);
    }
}
