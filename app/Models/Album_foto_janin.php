<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album_foto_janin extends Model
{
    //
    protected $table = 'album_foto_janins';
    protected $fillable = [
        'user_id',
        'nama'
    ];


}
