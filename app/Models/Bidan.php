<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidan extends Model
{
    //
    protected $fillable = [
        'user_id',
        'pendidikan_id',
        'pekerjaan_id',
        'provinsi_id',
        'kota_id',
        'image_id',
        'status_keanggotaan_ibi',
        'nama_tempat_praktik',
        'no_STR',
        'no_SIP'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
