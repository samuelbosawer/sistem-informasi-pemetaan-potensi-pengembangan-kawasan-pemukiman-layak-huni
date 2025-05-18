<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKriteria extends Model
{
    public function nilaiAlternatifs()
    {
        return $this->hasMany(JenisKriteria::class, 'kode_kriteria', 'kode_kriteria');
    }

}
