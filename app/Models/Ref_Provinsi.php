<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ref_Provinsi extends Model
{
    //
    protected $table = "Ref_Provinsis";

    public function kota(){
        return $this->belongsTo(Ref_Kota::class);
    }
}
