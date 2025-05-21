<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topsis extends Model
{
    public function alternatif()
    {
        return $this->belongsTo(Distrik::class, 'kode_distrik', 'kode_distrik');
    }
}
