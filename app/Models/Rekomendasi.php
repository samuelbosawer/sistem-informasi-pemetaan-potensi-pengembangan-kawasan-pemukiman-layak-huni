<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    public function strategi()
    {
        return $this->belongsTo(Strategi::class, 'strategi_id', 'id');
    }

    public function distrik()
    {
        return $this->belongsTo(Distrik::class, 'kode_distrik', 'kode_distrik');
    }
}
