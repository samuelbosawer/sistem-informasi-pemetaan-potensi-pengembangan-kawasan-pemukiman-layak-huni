<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    // public function jenis()
    // {
    //     return $this->belongsTo(JenisKriteria::class, 'jenis_kriteria_id');
    // }

public function kriteria()
{
    return $this->belongsTo(JenisKriteria::class, 'kode_kriteria', 'kode_kriteria');
}

// public function alternatif()
// {
//     return $this->belongsTo(Distrik::class, 'kode_distrik', 'kode_distrik');
// }

}
