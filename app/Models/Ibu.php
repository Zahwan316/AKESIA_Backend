<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ibu extends Model
{
    //
    protected $fillable = [
        'nik',
        'golongan_darah',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan',
        'pekerjaan',
        'alamat_domisili',
        'telepon',
        'no_registrasi_kohort_ibu',
        'Nama_Keluarga',
        'berat_badan',
        'tinggi_badan',
        'usia_kehamilan',
        'user_id',
    ];

    protected $table = "Ibus";

    public function User(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
