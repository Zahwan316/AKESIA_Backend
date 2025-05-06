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
        'tanggal_pendaftaran',
        'jam_pendaftaran',
        'status',
        'keluhan',
        'nama_anak',
        'umur_anak',
    ];

    public function pelayanan(){
        return $this->belongsTo(Pelayanan::class);
    }

    public function ibu(){
        return $this->belongsTo(Ibu::class);
    }

}
