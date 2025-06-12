<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_pelayanan_ibu_nifas extends Model
{
    //
    protected $table = 'form_pelayanan_ibu_nifas';
    protected $fillable = [
        'pemeriksaan_id',
        'klasifikasi_nifas_1',
        'tindakan_nifas_1',
        'tanggal_nifas_1',
        'klasifikasi_nifas_2',
        'tindakan_nifas_2',
        'tanggal_nifas_2',
        'klasifikasi_nifas_3',
        'tindakan_nifas_3',
        'tanggal_nifas_3',
        'klasifikasi_nifas_4',
        'tindakan_nifas_4',
        'tanggal_nifas_4',
    ];

    protected $casts = [
        'pemeriksaan_id' => 'integer',
        'klasifikasi_nifas_1' => 'string',
        'tindakan_nifas_1' => 'string',
        'tanggal_nifas_1' => 'string',
        'klasifikasi_nifas_2' => 'string',
        'tindakan_nifas_2' => 'string',
        'tanggal_nifas_2' => 'string',
        'klasifikasi_nifas_3' => 'string',
        'tindakan_nifas_3' => 'string',
        'tanggal_nifas_3' => 'string',
        'klasifikasi_nifas_4' => 'string',
        'tindakan_nifas_4' => 'string',
        'tanggal_nifas_4' => 'string',
    ];
}
