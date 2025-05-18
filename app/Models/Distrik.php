<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrik extends Model
{
  public function nilaiAlternatifs()
    {
        return $this->hasMany(JenisKriteria::class, 'kode_distrik', 'kode_kriteria');
    }

}
