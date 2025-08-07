<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DistrikSeeder::class);
        $this->call(JenisKriteriaSeeder::class);
        $this->call(KriteriaSeeder::class);
        $this->call(KeluhanSeeder::class);
        // $this->call(StrategiSeeder::class);
        // $this->call(RekomendasiSeeder::class);
    }
}
