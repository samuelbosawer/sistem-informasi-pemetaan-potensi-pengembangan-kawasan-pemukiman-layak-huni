<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    public function jenis()
    {
        return $this->belongsTo(JenisKriteria::class, 'jenis_kriteria_id');
    }
}
