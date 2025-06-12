<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_bayi_saat_lahir extends Model
{
    //
    protected $table = "form_bayi_saat_lahir";
    protected $fillable = [
        'pemeriksaan_id',
        'anak_ke',
        'berat_lahir',
        'panjang_badan',
        'lingkar_kepala',
        'jenis_kelamin',
        'kondisi_bayi_saat_lahir',
        'asuhan_bayi_baru_lahir'
    ];

    protected $casts = [
        'pemeriksaan_id' => 'integer',
        'anak_ke' => 'integer',
        'berat_lahir' => 'string',
        'panjang_badan' => 'string',
        'lingkar_kepala' => 'string',
        'jenis_kelamin' => 'string',
        'kondisi_bayi_saat_lahir' => 'string',
        'asuhan_bayi_baru_lahir' => 'string'
    ];
}
