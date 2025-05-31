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
        $keluhan = Keluhan::create([
            'keluhan' => 'Tanah Rawa',
            'tanggal' => Carbon::create(2025, 4, 12),
            'foto' => null,
            'distrik_id' => 1,
            'user_id' => 3
        ]);


        $keluhan = Keluhan::create([
            'keluhan' => 'Tanah Adat',
            'tanggal' => Carbon::create(2025, 4, 12),
            'foto' => null,
            'distrik_id' => 1,
            'user_id' => 3
        ]);



        $keluhan = Keluhan::create([
            'keluhan' => 'Tidak ada pelepasan tanah',
            'tanggal' => Carbon::create(2025, 4, 12),
            'foto' => null,
            'distrik_id' => 1,
            'user_id' => 3
        ]);
    }
}
