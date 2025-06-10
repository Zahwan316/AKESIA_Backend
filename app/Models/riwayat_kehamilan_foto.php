<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class riwayat_kehamilan_foto extends Model
{
    //
    protected $table = 'riwayat_kehamilan_fotos';
    protected $fillable = [
        'user_id', 'img_id', 'riwayat_kehamilan_group_id', 'nama'
    ];

    public function uploads(){
        return  $this->belongsTo(Upload::class, 'img_id');
    }
}
