<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_Pelayanan_Bayi extends Model
{
    //
    protected $table = "form_pelayanan_bayi";
    protected $fillable = [
        'pendaftaran_id', 'nama_bayi', 'umur_bayi', 'jenis_kelamin_bayi', 'booking_layanan', 'keterangan_kondisi_bayi', 'tambahan_layanan_id',
    ];
}
