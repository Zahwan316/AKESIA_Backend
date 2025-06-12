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
        'no_SIP',
        'jenis_praktik_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'pendidikan_id' => 'integer',
        'pekerjaan_id' => 'integer',
        'provinsi_id' => 'integer',
        'kota_id' => 'integer',
        'image_id' => 'integer',
        'status_keanggotaan_ibi' => 'string',
        'nama_tempat_praktik' => 'string',
        'no_STR' => 'string',
        'no_SIP' => 'string',
        'jenis_praktik_id' => 'integer',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function provinsi(){
        return $this->belongsTo(Ref_Provinsi::class);
    }

}
