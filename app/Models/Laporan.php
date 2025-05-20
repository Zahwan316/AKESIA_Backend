<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    //
    protected $table = 'laporans';
    protected $fillable = [
        'pemeriksaan_id',
        'ibu_id',
        'bayi_id',
        'jenis_pasien',
        'total_kunjungan'
    ];
}
