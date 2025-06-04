<?php

namespace Database\Seeders;

use App\Models\Peringkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeringkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            // Peringkat Tertinggi
            ['peringkat' => 1, 'tipe' => 'SO', 'keterangan' => 'Meningkatkan Kualitas Layanan Publik: Dengan memperbaiki layanan pendidikan, transportasi, dan fasilitas kesehatan, wilayah dapat menarik lebih banyak penduduk dan meningkatkan kualitas pemukiman.'],
            ['peringkat' => 1, 'tipe' => 'ST', 'keterangan' => 'Infrastruktur Tahan Bencana: Membangun infrastruktur yang lebih tahan bencana serta meningkatkan kesadaran masyarakat melalui program pendidikan kesiapsiagaan.'],

            ['peringkat' => 2, 'tipe' => 'SO', 'keterangan' => 'Pengembangan Pariwisata dan Infrastruktur: Memperbaiki dan memperluas infrastruktur guna mendukung pengembangan pariwisata yang berpotensi menjadi sektor ekonomi baru.'],
            ['peringkat' => 2, 'tipe' => 'ST', 'keterangan' => 'Kesiapsiagaan Bencana: Membangun sistem yang lebih tahan terhadap bencana serta mengedukasi masyarakat untuk menghadapi ancaman bencana.'],

            ['peringkat' => 3, 'tipe' => 'SO', 'keterangan' => 'Pengembangan Infrastruktur Publik: Meningkatkan kualitas transportasi dan kesehatan untuk mendukung pengembangan kawasan dan menarik lebih banyak penduduk.'],
            ['peringkat' => 3, 'tipe' => 'ST', 'keterangan' => 'Peningkatan Kapasitas SDM: Mengedukasi tenaga kerja lokal untuk menghadapi tantangan ekonomi dengan lebih baik melalui program pelatihan dan pengembangan skill.'],

            // Peringkat Terendah
            ['peringkat' => 17, 'tipe' => 'WO', 'keterangan' => 'Optimalisasi Lahan: Menggunakan layanan publik untuk memaksimalkan tata ruang, seperti membuat fasilitas terpadu yang lebih efisien.'],
            ['peringkat' => 17, 'tipe' => 'WT', 'keterangan' => 'Rencana Tata Ruang Tahan Bencana: Menerapkan tata ruang yang tangguh untuk meminimalkan dampak bencana serta memanfaatkan lahan secara efisien.'],

            ['peringkat' => 18, 'tipe' => 'WO', 'keterangan' => 'Pengembangan Pariwisata untuk Keamanan: Menggunakan potensi pariwisata untuk meningkatkan keamanan melalui partisipasi masyarakat dalam pengawasan sosial.'],
            ['peringkat' => 18, 'tipe' => 'WT', 'keterangan' => 'Program Komunitas untuk Keamanan: Menerapkan program komunitas untuk menjaga stabilitas sosial ekonomi dan meningkatkan keamanan wilayah.'],

            ['peringkat' => 19, 'tipe' => 'WO', 'keterangan' => 'Optimalisasi Lahan Publik: Memanfaatkan peningkatan layanan publik untuk meningkatkan efisiensi tata ruang.'],
            ['peringkat' => 19, 'tipe' => 'WT', 'keterangan' => 'Pengelolaan Risiko Bencana: Mengoptimalkan penggunaan lahan terbatas untuk meminimalkan kerugian akibat bencana dan menjaga stabilitas sosial.'],
        ];

         Peringkat::insert($data);
    }
}
