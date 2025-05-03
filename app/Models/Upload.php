<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //
    protected $fillable = [
        'nama',
        'path',
        'keterangan',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function jenis_layanan(){
        return $this->belongsTo(Jenis_layanan::class);
    }
}
