<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    //
    protected $fillable = [
        'ibu_id',
        'bidan_id',
        'pelayanan_id',
        'bayi_id',
        'tanggal_pendaftaran',
        'jam_pendaftaran',
        'jam_ditentukan',
        'status',
        'keluhan',
        'isVerif',
    ];

    public function pelayanan(){
        return $this->belongsTo(Pelayanan::class);
    }

    public function ibu(){
        return $this->belongsTo(Ibu::class);
    }

    public function bayi(){
        return $this->belongsTo(Bayi::class);
    }

    public function bidan(){
        return $this->belongsTo(Bidan::class);
    }


}
