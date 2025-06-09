<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Strategi extends Model
{
//     public function kriteriaStrategis()
//     {
//         return $this->belongsToMany(KriteriaStrategi::class, 'kriteria_strategis', 'kriteria_id', 'jenis_kriteria_id');
//     }

//     public function jenisKriteria()
// {
//     return $this->belongsToMany(KriteriaStrategi::class, 'pivot_table', 'kriteria_id', 'jenis_kriteria_id');
// }




    public function satu()
    {
        return $this->belongsTo(JenisKriteria::class, 'strategi_satu', 'id');
    }

     public function dua()
    {
        return $this->belongsTo(JenisKriteria::class, 'strategi_dua', 'id');
    }

    public function tiga()
    {
        return $this->belongsTo(JenisKriteria::class, 'strategi_tiga', 'id');
    }

    public function empat()
    {
        return $this->belongsTo(JenisKriteria::class, 'strategi_empat', 'id');
    }


}
