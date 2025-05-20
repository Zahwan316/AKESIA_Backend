<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_pemeriksaan_lab extends Model
{
    //
    protected $table = "form_pemeriksaan_lab";

    protected $fillable = [
        'pemeriksaan_id',
        'tanggal_pemeriksaan',
        'jam_pemeriksaan',
        'nama',
        'hasil',
        'tanggal_pelayanan',
        'jam_pelayanan',
        'soap',
        'penatalaksanaan'
    ];
}
