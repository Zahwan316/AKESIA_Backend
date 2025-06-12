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
    protected $casts = [
        'pemeriksaan_id' => 'integer',
        'gravida' => 'string',
        'partus' => 'string',
        'rr_rt' => 'string',
        'hpl' => 'string',
        'hpht' => 'string',
        'muntah' => 'string',
        'pusing' => 'string',
        'nyeri_perut' => 'string',
        'nafsu_makan' => 'string',
        'pendarahan' => 'string',
        'riwayat_penyakit' => 'string',
        'riwayat_penyakit_keluarga' => 'string',
        'kebiasaan' => 'string',
        'keluhan' => 'string',
        'pasangan_sexual_istri' => 'string',
        'pasangan_sexual_suami' => 'string',
        'mendiskusikan_hiv' => 'string'
    ];

    public function pemeriksaan(){
        return $this->belongsTo(Pemeriksaan::class);
    }
}
