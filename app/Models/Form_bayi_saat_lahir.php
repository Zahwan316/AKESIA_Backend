<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_bayi_saat_lahir extends Model
{
    //
    protected $table = "form_bayi_saat_lahir";
    protected $fillable = [
        'pendaftaran_id',
        'anak_ke',
        'berat_lahir',
        'panjang_badan',
        'lingkar_kepala',
        'jenis_kelamin',
        'kondisi_bayi_saat_lahir',
        'asuhan_bayi_baru_lahir'
    ];
}
