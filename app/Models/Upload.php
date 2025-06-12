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

    protected $casts = [
        'nama' => 'string',
        'path' => 'string',
        'keterangan' => 'string',
        'user_id' => 'integer'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function jenis_layanan(){
        return $this->belongsTo(Jenis_layanan::class);
    }
}
