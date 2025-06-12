<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ibu extends Model
{
    protected $table = "ibus";
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
        'hpht',
        'usia_kehamilan',
    ];

    protected $casts = [
        'nik' => 'string',
        'golongan_darah' => 'string',
        'tempat_lahir' => 'string',
        'tanggal_lahir' => 'string',
        'pendidikan' => 'integer',
        'pekerjaan' => 'integer',
        'alamat_domisili' => 'string',
        'telepon' => 'string',
        'no_registrasi_kohort_ibu' => 'string',
        'Nama_Keluarga' => 'string',
        'berat_badan' => 'integer',
        'tinggi_badan' => 'integer',
        'usia_kehamilan' => 'integer',
        'user_id' => 'integer',
        'hpht' => 'string',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ibu() {
        return $this->hasMany(Pendaftaran::class);
    }
}
