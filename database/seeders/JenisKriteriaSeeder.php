<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisKriteria;
use Illuminate\Support\Facades\DB;

class JenisKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode_kriteria' => 'C1', 'kriteria' => 'Akses ke Jalan Raya', 'penilaian' => '5', 'rating' => '5', 'faktor' => 'Strengths', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C2', 'kriteria' => 'Ketersediaan Transportasi Umum', 'penilaian' => '5', 'rating' => '5', 'faktor' => 'Strengths', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C3', 'kriteria' => 'Kondisi Geografis yang Mendukung', 'penilaian' => '4', 'rating' => '4', 'faktor' => 'Strengths', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C4', 'kriteria' => 'Jumlah Sekolah Dasar dan Menengah', 'penilaian' => '4', 'rating' => '4', 'faktor' => 'Strengths', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C5', 'kriteria' => 'Ketersediaan Pusat Pendidikan Lanjutan', 'penilaian' => '5', 'rating' => '5' , 'faktor' => 'Strengths', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C6', 'kriteria' => 'Adanya Fasilitas Kesehatan', 'penilaian' => '5', 'rating' => '5' , 'faktor' => 'Strengths', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C7',  'kriteria' => 'Kondisi Lingkungan yang Bersih', 'penilaian' => '3', 'rating' => '3' , 'faktor' => 'Strengths', 'label' => 'Benefit' ],

            ['kode_kriteria' => 'C8',  'kriteria' => 'Keterbatasan Lahan untuk Pengembangan', 'penilaian' => ' 3', 'rating' => '3' , 'faktor' => 'Weaknesses', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C9',  'kriteria' => 'Kualitas Infrastruktur Eksisting yang Kurang Memadai', 'penilaian' => '3 ', 'rating' => '3' , 'faktor' => 'Weaknesses', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C10', 'kriteria' => 'Ketersediaan Sumber Daya Air yang Terbatas', 'penilaian' => '3 ', 'rating' => '3' , 'faktor' => 'Weaknesses', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C11', 'kriteria' => 'Tingkat Keamanan yang Rendah', 'penilaian' => '4 ', 'rating' => '4' , 'faktor' => 'Weaknesses', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C12', 'kriteria' => 'Keterbatasan Akses Kesehatan', 'penilaian' => '5 ', 'rating' => '5' , 'faktor' => 'Weaknesses', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C13', 'kriteria' => 'Adanya fasilitas perumahan yang layak huni', 'penilaian' => ' 3', 'rating' => '3' , 'faktor' => 'Weaknesses', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C14', 'kriteria' => 'Keterbatasan Sarana Sosial dan Rekreasi.', 'penilaian' => '2 ', 'rating' => '2' , 'faktor' => 'Weaknesses', 'label' => 'Cost' ],

            ['kode_kriteria' => 'C15', 'kriteria' => 'Rencana Peningkatan Akses Air Bersih', 'penilaian' => '4', 'rating' => '4' , 'faktor' => 'Opportunities', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C16', 'kriteria' => 'Pengembangan Jaringan Listrik', 'penilaian' => '3', 'rating' => '3' , 'faktor' => 'Opportunities', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C17', 'kriteria' => 'Perbaikan Sistem Sanitasi', 'penilaian' => '2', 'rating' => '2' , 'faktor' => 'Opportunities', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C18', 'kriteria' => 'Potensi Wisata Alam', 'penilaian' => '3', 'rating' => '3' , 'faktor' => 'Opportunities', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C19', 'kriteria' => 'Pengembangan Ekowisata', 'penilaian' => '5', 'rating' => '5' , 'faktor' => 'Opportunities', 'label' => 'Benefit' ],
            ['kode_kriteria' => 'C20', 'kriteria' => 'Pertumbuhan Ekonomi Lokal', 'penilaian' => '2', 'rating' => '2' , 'faktor' => 'Opportunities', 'label' => 'Benefit' ],

            ['kode_kriteria' => 'C21', 'kriteria' => 'Risiko Banjir', 'penilaian' => '3', 'rating' => '3' , 'faktor' => 'Threats', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C22', 'kriteria' => 'Risiko Gempa Bumi', 'penilaian' => '3', 'rating' => '3' , 'faktor' => 'Threats', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C23', 'kriteria' => 'Risiko Longsor', 'penilaian' => '3', 'rating' => '3' , 'faktor' => 'Threats', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C24', 'kriteria' => 'Perubahan Iklim', 'penilaian' => '2', 'rating' => '2' , 'faktor' => 'Threats', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C25', 'kriteria' => 'Harga Lahan yang Fluktuatif', 'penilaian' => '2', 'rating' => '2' , 'faktor' => 'Threats', 'label' => 'Cost' ],
            ['kode_kriteria' => 'C26', 'kriteria' => 'Keterbatasan Infrastruktur Digital', 'penilaian' => '2', 'rating' => '2' , 'faktor' => 'Threats', 'label' => 'Cost' ],
        ];
        DB::table('jenis_kriterias')->insert($data);
    }
}
