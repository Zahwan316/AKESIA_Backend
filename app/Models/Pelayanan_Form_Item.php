<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan_Form_Item extends Model
{
    //
    protected $table = 'pelayanan_form_item';
    protected $fillable = [
        'pelayanan_id',
        'form_id',
    ];

    protected $casts = [
        'pelayanan_id' => 'integer',
        'form_id' => 'integer',
    ];

    public function pelayanan(){
        return $this->belongsTo(Pelayanan::class, 'pelayanan_id');
    }

    public function form(){
        return $this->belongsTo(Ref_jenis_form::class, 'form_id');
    }
}
