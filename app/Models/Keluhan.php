<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function distrik()
    {
        return $this->belongsTo(User::class, 'distrik_id');
    }
}
