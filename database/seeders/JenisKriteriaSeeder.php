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
            ['kode_kriteria' => 'C1', 'kriteria' => 'Akses ke Jalan Raya', 'skor' => '0.463'],
            ['kode_kriteria' => 'C2', 'kriteria' => 'Ketersediaan Transportasi Umum', 'skor' => '0.463'],
            ['kode_kriteria' => 'C3', 'kriteria' => 'Kondisi Geografis yang Mendukung', 'skor' => '0.296'],
            ['kode_kriteria' => 'C4', 'kriteria' => 'Jumlah Sekolah Dasar dan Menengah', 'skor' => '0.296'],
            ['kode_kriteria' => 'C5', 'kriteria' => 'Ketersediaan Pusat Pendidikan Lanjutan', 'skor' => '0.463'],
            ['kode_kriteria' => 'C6', 'kriteria' => 'Adanya Fasilitas Kesehatan', 'skor' => '0.463'],
            ['kode_kriteria' => 'C7',  'kriteria' => 'Kondisi Lingkungan yang Bersih', 'skor' => '0.167'],
            ['kode_kriteria' => 'C8',  'kriteria' => 'Keterbatasan Lahan untuk Pengembangan', 'skor' => '0.167'],
            ['kode_kriteria' => 'C9',  'kriteria' => 'Kualitas Infrastruktur Eksisting yang Kurang Memadai', 'skor' => '0.167'],
            ['kode_kriteria' => 'C10', 'kriteria' => 'Ketersediaan Sumber Daya Air yang Terbatas', 'skor' => '0.167'],
            ['kode_kriteria' => 'C11', 'kriteria' => 'Tingkat Keamanan yang Rendah', 'skor' => '0.296'],
            ['kode_kriteria' => 'C12', 'kriteria' => 'Keterbatasan Akses Kesehatan', 'skor' => '0.463'],
            ['kode_kriteria' => 'C13', 'kriteria' => 'Adanya fasilitas perumahan yang layak huni', 'skor' => '0.167'],
            ['kode_kriteria' => 'C14', 'kriteria' => 'Keterbatasan Sarana Sosial dan Rekreasi.', 'skor' => '0.074'],
            ['kode_kriteria' => 'C15', 'kriteria' => 'Rencana Peningkatan Akses Air Bersih', 'skor' => '0.471'],
            ['kode_kriteria' => 'C16', 'kriteria' => 'Pengembangan Jaringan Listrik', 'skor' => '0.265'],
            ['kode_kriteria' => 'C17', 'kriteria' => 'Perbaikan Sistem Sanitasi', 'skor' => '0.118'],
            ['kode_kriteria' => 'C18', 'kriteria' => 'Potensi Wisata Alam', 'skor' => '0.265'],
            ['kode_kriteria' => 'C19', 'kriteria' => 'Pengembangan Ekowisata', 'skor' => '0.735'],
            ['kode_kriteria' => 'C20', 'kriteria' => 'Pertumbuhan Ekonomi Lokal', 'skor' => '0.118'],
            ['kode_kriteria' => 'C21', 'kriteria' => 'Risiko Banjir', 'skor' => '0.265'],
            ['kode_kriteria' => 'C22', 'kriteria' => 'Risiko Gempa Bumi', 'skor' => '0.265'],
            ['kode_kriteria' => 'C23', 'kriteria' => 'Risiko Longsor', 'skor' => '0.265'],
            ['kode_kriteria' => 'C24', 'kriteria' => 'Perubahan Iklim', 'skor' => '0.118'],
            ['kode_kriteria' => 'C25', 'kriteria' => 'Harga Lahan yang Fluktuatif', 'skor' => '0.118'],
            ['kode_kriteria' => 'C26', 'kriteria' => 'Keterbatasan Infrastruktur Digital', 'skor' => '0.118'],
        ];
        DB::table('jenis_kriterias')->insert($data);
    }
}
