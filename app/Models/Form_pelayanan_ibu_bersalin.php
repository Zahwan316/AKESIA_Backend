<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form_pelayanan_ibu_bersalin extends Model
{
    //
    protected $table = "form_pelayanan_ibu_bersalin";
    protected $fillable = [
        'pendaftaran_id',
        'tanggal_persalinan',
        'jam_lahir',
        'umur_kehamilan',
        'penolong_persalinan',
        'cara_persalinan',
        'keadaan_ibu',
        'kb_pasca_persalinan',
        'keterangan_tambahan'
    ];
}
