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
        'no_registrasi_kohort_ibu',
        'no_catatan_medik_rs',
        'anak_ke',
    ];

    protected $casts = [
        'ibu_id' => 'integer',
        'nama_lengkap' => 'string',
        'jenis_kelamin' => 'string',
        'nik' => 'string',
        'golongan_darah' => 'string',
        'tempat_lahir' => 'string',
        'tanggal_lahir' => 'date',
        'no_akta_kelahiran' => 'string',
        'no_registrasi_kohort_bayi' => 'string',
        'no_registrasi_kohort_balita' => 'string',
        'no_registrasi_kohort_ibu' => 'string',
        'no_catatan_medik_rs' => 'string',
        'anak_ke' => 'integer',
    ];

}
