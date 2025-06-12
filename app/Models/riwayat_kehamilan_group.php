<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class riwayat_kehamilan_group extends Model
{
    //
    protected $table = 'riwayat_kehamilan_groups';
    protected $fillable = [
        'user_id',
        'nama',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'nama' => 'string',
    ];
}
