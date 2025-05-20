<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    //
    protected $table = 'pemeriksaans';
    protected $fillable = [
        'bidan_id',
        'ibu_id',
        'pelayanan_id',
        'pendaftaran_id',
        'harga',
        'tanggal_kunjungan',
        'jam_kunjungan'
    ];
}
