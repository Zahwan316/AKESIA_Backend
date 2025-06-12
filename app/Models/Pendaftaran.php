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

    protected $casts = [
        'ibu_id' => 'integer',
        'bidan_id' => 'integer',
        'pelayanan_id' => 'integer',
        'bayi_id' => 'integer',
        'tanggal_pendaftaran' => 'string',
        'jam_pendaftaran' => 'string',
        'jam_ditentukan' => 'string',
        'status' => 'string',
        'keluhan' => 'string',
        'isVerif' => 'boolean',
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
