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

    public function bidan(){
        return $this->belongsTo(Bidan::class);
    }

    public function form_pelayanan_bayi(){
        return $this->hasMany(Form_Pelayanan_Bayi::class, 'pemeriksaan_id');
    }

    public function form_pemeriksaan_umum(){
        return $this->hasMany(Form_pemeriksaan_umum::class, 'pemeriksaan_id');
    }


}
