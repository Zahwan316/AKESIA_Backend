<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ref_Kota extends Model
{
    //
    protected $table = "Ref_Kotas";

    public function provinsi(){
        return $this->belongsTo(Ref_Provinsi::class);
    }
}
