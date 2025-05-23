<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_Pelayanan_Bayi extends Model
{
    //
    protected $table = "form_pelayanan_bayi";
    protected $fillable = [
        'pemeriksaan_id', 'nama_bayi', 'umur_bayi', 'jenis_kelamin_bayi', 'booking_layanan', 'keterangan_kondisi_bayi', 'tambahan_layanan_id',
    ];

    public function tambahan_layanan (){
        return $this->belongsTo(Tambahan_layanan::class, 'tambahan_layanan_id');
    }
}
