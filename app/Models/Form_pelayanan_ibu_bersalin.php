<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_pelayanan_ibu_bersalin extends Model
{
    //
    protected $table = "form_pelayanan_ibu_bersalin";
    protected $fillable = [
        'pemeriksaan_id',
        'tanggal_persalinan',
        'jam_lahir',
        'umur_kehamilan',
        'penolong_persalinan',
        'cara_persalinan',
        'keadaan_ibu',
        'kb_pasca_persalinan',
        'keterangan_tambahan'
    ];

    protected $casts = [
        'pemeriksaan_id' => 'integer',
        'tanggal_persalinan' => 'string',
        'jam_lahir' => 'string',
        'umur_kehamilan' => 'string',
        'penolong_persalinan' => 'string',
        'cara_persalinan' => 'string',
        'keadaan_ibu' => 'string',
        'kb_pasca_persalinan' => 'string',
        'keterangan_tambahan' => 'string'
    ];
}
