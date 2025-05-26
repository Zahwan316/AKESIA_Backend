<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_pemeriksaan_umum extends Model
{
    //
    protected $table = "form_pemeriksaan_umum";

    protected $fillable = [
        'bentuk_tubuh',
        'pemeriksaan_id',
        'kesadaran_id',
        'mata',
        'leher',
        'payudara',
        'paru',
        'jantung',
        'hati',
        'suhu_badan',
        'genetalia',
        'tinggi_badan',
        'berat_badan',
        'soap',
        'tanggal_kontrol_kembali'
    ];
}
