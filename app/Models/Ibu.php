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
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ibu() {
        return $this->hasMany(Pendaftaran::class);
    }
}
