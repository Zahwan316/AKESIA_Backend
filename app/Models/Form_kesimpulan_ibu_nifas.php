<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_kesimpulan_ibu_nifas extends Model
{
    //
    protected $table = 'form_kesimpulan_ibu_nifas';
    protected $fillable = [
        'pemeriksaan_id',
        'keadaan_ibu',
        'komplikasi_nifas',
        'keadaan_bayi',
    ];

    protected $casts = [
        'pemeriksaan_id' => 'integer',
        'keadaan_ibu' => 'string',
        'komplikasi_nifas' => 'string',
        'keadaan_bayi' => 'string',
    ];
}
