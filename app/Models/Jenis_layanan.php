<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis_layanan extends Model
{
    //
    protected $fillable = [
        'nama',
        'keterangan',
        'img_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'img_id' => 'integer',
    ];


    public function upload(){
        return $this->hasOne('App\Models\Upload','id','img_id');
    }
}
