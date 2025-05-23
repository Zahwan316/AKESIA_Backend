<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album_foto_usg extends Model
{
    //
    protected $table = 'album_foto_usgs';
    protected $fillable = [
        'user_id',
        'janin_id',
        'nama'
    ];

    public function janin(){
        return $this->belongsTo(Album_foto_janin::class, 'janin_id');
    }

}
