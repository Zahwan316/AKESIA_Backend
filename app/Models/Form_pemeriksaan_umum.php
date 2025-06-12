<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_pemeriksaan_umum extends Model
{
    //
    protected $table = "form_pemeriksaan_umum";

    protected $fillable = [
        'bentuk_tubuh',
        'pemeriksaan_id',
        'kesadaran_id',
        'mata',
        'leher',
        'payudara',
        'paru',
        'jantung',
        'hati',
        'suhu_badan',
        'genetalia',
        'tinggi_badan',
        'berat_badan',
        'soap',
        'tanggal_kontrol_kembali'
    ];

    protected $casts = [
        'bentuk_tubuh' => 'string',
        'pemeriksaan_id' => 'integer',
        'kesadaran_id' => 'integer',
        'mata' => 'string',
        'leher' => 'string',
        'payudara' => 'string',
        'paru' => 'string',
        'jantung' => 'string',
        'hati' => 'string',
        'suhu_badan' => 'float',
        'genetalia' => 'string',
        'tinggi_badan' => 'integer',
        'berat_badan' => 'string',
        'soap' => 'string',
        'tanggal_kontrol_kembali' => 'string'
    ];

    public function pemeriksaan(){
        return $this->belongsTo(Pemeriksaan::class);
    }
}
