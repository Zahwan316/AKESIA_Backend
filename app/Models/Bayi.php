<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayi extends Model
{
    //
    protected $fillable = [
        'ibu_id',
        'nama_lengkap',
        'jenis_kelamin',
        'nik',
        'golongan_darah',
        'tempat_lahir',
        'tanggal_lahir',
        'no_akta_kelahiran',
        'no_registrasi_kohort_bayi',
        'no_registrasi_kohort_balita',
        'no_catatan_medik_rs',
        'anak_ke',
    ];
}
