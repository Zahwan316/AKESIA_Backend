<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album_foto extends Model
{
    //
    protected $table = 'album_fotos';
    protected $fillable = [
        'img_id',
        'user_id',
        'usg_id',
        'judul',
        'caption',
        'tanggal'
    ];

    protected $casts = [
        'img_id' => 'integer',
        'user_id' => 'integer',
        'usg_id' => 'integer',
        'judul' => 'string',
    ];



    public function uploads(){
        return $this->belongsTo(Upload::class, 'img_id','id');
    }

    public function usg(){
        return $this->belongsTo(Album_foto_usg::class, 'usg_id');
    }
}
