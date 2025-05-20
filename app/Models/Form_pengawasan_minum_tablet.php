<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_pengawasan_minum_tablet extends Model
{
    //
    protected $table = "form_pengawasan_minum_tablet";
    protected $fillable = [
        'pemeriksaan_id',
        'bulan_ke',
        'tanggal',
        'jam'
    ];
}
