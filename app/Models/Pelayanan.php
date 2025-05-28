<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    //
    protected $fillable = [
        'nama',
        'jenis_layanan_id',
        'keterangan',
        'harga',
        'form_id',
    ];


    public function pendaftaran(){
        return $this->hasOne(Pendaftaran::class);
    }

    public function upload(){
        return $this->hasOne(Upload::class);
    }

    public function jenis_layanan(){
        return $this->belongsTo(Jenis_layanan::class);
    }

    public function formItems()
{
    return $this->hasMany(Pelayanan_Form_Item::class);
}
}
