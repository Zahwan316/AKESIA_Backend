<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_riwayat_kehamilan_sebelumnya extends Model
{
    //
    protected $table = "form_riwayat_kehamilan_sebelumnya";
    protected $fillable = [
        'pemeriksaan_id',
        'anak_ke',
        'apiah',
        'umur_anak',
        'p_l',
        'bbl',
        'cara_persalinan',
        'penolong',
        'tempat_persalinan',
        'keterangan',
    ];

    protected $casts = [
        'pemeriksaan_id' => 'integer',
        'anak_ke' => 'integer',
        'apiah' => 'string',
        'umur_anak' => 'integer',
        'p_l' => 'string',
        'bbl' => 'string',
        'cara_persalinan' => 'string',
        'penolong' => 'string',
        'tempat_persalinan' => 'string',
        'keterangan' => 'string',
    ];

    public function pemeriksaan(){
        return $this->belongsTo(Pemeriksaan::class);
    }
}
