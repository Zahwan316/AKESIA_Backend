<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_layanan_ibu_lainnya extends Model
{
    //
    protected $table = "form_layanan_ibu_lainnya";
    protected $fillable = [
        'pemeriksaan_id',
        'nama_ibu',
        'umur_ibu',
        'booking_layanan',
        'catatan_soap',
        'keterangan',
    ];

    protected $casts = [
        'pemeriksaan_id' => 'integer',
        'nama_ibu' => 'string',
        'umur_ibu' => 'integer',
        'booking_layanan' => 'string',
        'catatan_soap' => 'string',
        'keterangan' => 'string',
    ];
}
