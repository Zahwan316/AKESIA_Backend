<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_pelayanan_ibu_nifas extends Model
{
    //
    protected $table = 'form_pelayanan_ibu_nifas';
    protected $fillable = [
        'pendaftaran_id',
        'klasifikasi_nifas_1',
        'tindakan_nifas_1',
        'tanggal_nifas_1',
        'klasifikasi_nifas_2',
        'tindakan_nifas_2',
        'tanggal_nifas_2',
        'klasifikasi_nifas_3',
        'tindakan_nifas_3',
        'tanggal_nifas_3',
    ];
}
