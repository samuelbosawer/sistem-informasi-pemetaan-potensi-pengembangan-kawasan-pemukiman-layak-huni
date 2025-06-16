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
            'latitude' => -3.139209,
            'longitude' => 139.948453,
            'status' => 'Publish',
            'distrik_id' => 11,
            'user_id' => 3
        ]);


        $keluhan = Keluhan::create([
            'keluhan' => 'Tanah Adat',
            'tanggal' => Carbon::create(2025, 4, 12),
            'foto' => null,
            'latitude' => -3.209611,
            'longitude' =>  139.965873,
            'status' => 'Publish',
            'distrik_id' => 11,
            'user_id' => 3
        ]);



        $keluhan = Keluhan::create([
            'keluhan' => 'Tidak ada pelepasan tanah',
            'tanggal' => Carbon::create(2025, 4, 12),
            'foto' => null,
            'latitude' => -3.209459,
            'longitude' => 139.961211,
            'status' => 'Publish',
            'distrik_id' => 11,
            'user_id' => 3
        ]);
    }
}
