<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $table = 'banner';
    protected $fillable = [
        'img_id',
        'name',
    ];

    public function upload(){
        return $this->belongsTo(Upload::class, 'img_id');
    }
}
