<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    //
    protected $table = 'pemeriksaans';
    protected $fillable = [
        'bidan_id',
        'ibu_id',
        'pelayanan_id',
        'pendaftaran_id',
        'harga',
        'tanggal_kunjungan',
        'jam_kunjungan'
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
    public function pendaftaran(){
        return $this->belongsTo(Pendaftaran::class);
    }
}
