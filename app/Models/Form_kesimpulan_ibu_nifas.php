<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_kesimpulan_ibu_nifas extends Model
{
    //
    protected $table = 'form_kesimpulan_ibu_nifas';
    protected $fillable = [
        'pendaftaran_id',
        'keadaan_ibu',
        'komplikasi_nifas',
        'keadaan_bayi',
    ];
}
