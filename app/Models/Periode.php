<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $guarded = [];

     public function distrik()
    {
        return $this->belongsTo(Distrik::class, 'kode_distrik', 'kode_distrik');
    }
}
