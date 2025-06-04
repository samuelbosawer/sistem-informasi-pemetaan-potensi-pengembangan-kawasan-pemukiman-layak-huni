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
            [
                'tipe' => 'SO',
                'keterangan' => 'Memanfaatkan infrastruktur transportasi yang baik untuk mendukung pengembangan ekowisata dan potensi wisata alam.',
                // 'strategi_id' => [1, 2, 18, 19]
            ],

            [
                'tipe' => 'SO',
                'keterangan' => 'Menggunakan pusat pendidikan lanjutan untuk meningkatkan kapasitas SDM yang mendukung pertumbuhan ekonomi lokal.',
                // 'strategi_id' => [1, 2, 18, 19]
            ],

            [
                'tipe' => 'SO',
                'keterangan' => 'Mengoptimalkan perbaikan sistem sanitasi dan peningkatan akses air bersih untuk meningkatkan kualitas hidup.',
                // 'strategi_id' => [1, 2, 18, 19]
            ],

            [
                'tipe' => 'WO',
                'keterangan' => 'Mengatasi keterbatasan lahan melalui kebijakan tata ruang yang efisien dan berkelanjutan.',
                // 'strategi_id' => [8]
            ],


            [
                'tipe' => 'WO',
                'keterangan' => 'Meningkatkan kualitas infrastruktur dengan dukungan dari pertumbuhan ekonomi lokal dan pengembangan jaringan listrik.',
                // 'strategi_id' => [8]
            ],


            [
                'tipe' => 'WO',
                'keterangan' => 'Mengembangkan fasilitas sosial dan rekreasi untuk meningkatkan kesejahteraan masyarakat.',
                // 'strategi_id' => [8]
            ],


            [
                'tipe' => 'ST',
                'keterangan' => 'Membangun sistem mitigasi bencana untuk mengatasi risiko banjir, gempa bumi, dan longsor.',
                // 'strategi_id' => [21, 22, 23]
            ],

            [
                'tipe' => 'ST',
                'keterangan' => 'Meningkatkan kesadaran masyarakat terhadap dampak perubahan iklim dan pentingnya menjaga lingkungan.',
                // 'strategi_id' => [21, 22, 23]
            ],


            [
                'tipe' => 'ST',
                'keterangan' => 'Memanfaatkan transportasi umum yang baik untuk evakuasi cepat saat terjadi bencana',
                // 'strategi_id' => [21, 22, 23]
            ],




            [
                'tipe' => 'WT',
                'keterangan' => 'Meningkatkan kapasitas sarana kesehatan untuk menghadapi risiko bencana.',
                // 'strategi_id' => [6, 12]
            ],


             [
                'tipe' => 'WT',
                'keterangan' => 'Mengembangkan infrastruktur digital untuk mendukung ketahanan ekonomi dan sosial masyarakat.',
                // 'strategi_id' => [6, 12]
            ],


             [
                'tipe' => 'WT',
                'keterangan' => 'Melakukan kerja sama dengan pihak swasta untuk mengatasi keterbatasan lahan dan meningkatkan kualitas infrastruktur.',
                // 'strategi_id' => [6, 12]
            ],
        ];

        foreach ($strategies as $s) {
            $strategy = Strategi::create([
                'tipe' => $s['tipe'],
                'keterangan' => $s['keterangan'],
            ]);

            //  Attach ke tabel pivot kriteria_strategis
            // if (!empty($s['strategi_id'])) {
            //     $strategy->kriteriaStrategis()->attach($s['strategi_id']);
            // }
        }
    }
}
