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

    public function pemeriksaan(){
        return $this->belongsTo(Pemeriksaan::class);
    }
}
