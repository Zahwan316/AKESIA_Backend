<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_Pelayanan_Bayi extends Model
{
    //
    protected $table = "form_pelayanan_bayi";
    protected $fillable = [
        'pemeriksaan_id',
        'nama_bayi',
        'tanggal_lahir',
        'jenis_kelamin_bayi',
        'booking_layanan',
        'keterangan_kondisi_bayi',
        'tambahan_layanan_id',
    ];

    protected $casts = [
        'pemeriksaan_id' => 'integer',
        'nama_bayi' => 'string',
        'tanggal_lahir' => 'string',
        'jenis_kelamin_bayi' => 'string',
        'booking_layanan' => 'string',
        'keterangan_kondisi_bayi' => 'string',
        'tambahan_layanan_id' => 'integer',
    ];

    public function tambahan_layanan (){
        return $this->belongsTo(Tambahan_layanan::class, 'tambahan_layanan_id');
    }
}
