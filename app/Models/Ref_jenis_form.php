<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ref_jenis_form extends Model
{
    //
    protected $table = 'Ref_jenis_form';

    protected function pelayanan_form_item(){
        return $this->hasMany('pelayanan_form_item',);
    }
}
