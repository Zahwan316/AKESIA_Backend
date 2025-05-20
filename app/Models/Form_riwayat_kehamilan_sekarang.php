<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_riwayat_kehamilan_sekarang extends Model
{
    //
    protected $table = "form_riwayat_kehamilan_sekarang";
    protected $fillable = [
        'pemeriksaan_id',
        'gravida',
        'partus',
        'rr_rt',
        'hpl',
        'hpht',
        'muntah',
        'pusing',
        'nyeri_perut',
        'nafsu_makan',
        'pendarahan',
        'riwayat_penyakit',
        'riwayat_penyakit_keluarga',
        'kebiasaan',
        'keluhan',
        'pasangan_sexual_istri',
        'pasangan_sexual_suami',
        'mendiskusikan_hiv'
    ];
}
