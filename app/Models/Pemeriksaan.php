<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    //
    protected $table = 'pemeriksaans';
    protected $fillable = [
        'bidan_id',
        'ibu_id',
        'pelayanan_id',
        'pendaftaran_id',
        'harga',
        'tanggal_kunjungan',
        'jam_kunjungan'
    ];

    protected $casts = [
        'id' => 'integer',
        'bidan_id' => 'integer',
        'ibu_id' => 'integer',
        'pelayanan_id' => 'integer',
        'pendaftaran_id' => 'integer',
        'harga' => 'integer',
    ];


    public function pelayanan(){
        return $this->belongsTo(Pelayanan::class);
    }

    public function ibu(){
        return $this->belongsTo(Ibu::class);
    }

    public function bayi(){
        return $this->belongsTo(Bayi::class);
    }

    public function pendaftaran(){
        return $this->belongsTo(Pendaftaran::class);
    }

    public function bidan(){
        return $this->belongsTo(Bidan::class);
    }

    public function form_pelayanan_bayi(){
        return $this->hasMany(Form_Pelayanan_Bayi::class, 'pemeriksaan_id');
    }

    public function form_pemeriksaan_umum(){
        return $this->hasMany(Form_pemeriksaan_umum::class, 'pemeriksaan_id');
    }

    public function form_bayi_saat_lahir(){
        return $this->hasMany(Form_bayi_saat_lahir::class, 'pemeriksaan_id');
    }

    public function form_kesimpulan_ibu_nifas(){
        return $this->hasMany(Form_kesimpulan_ibu_nifas::class, 'pemeriksaan_id');
    }

    public function form_layanan_ibu_lainnya(){
        return $this->hasMany(Form_layanan_ibu_lainnya::class, 'pemeriksaan_id');
    }

    public function form_pelayanan_ibu_bersalin(){
        return $this->hasMany(Form_pelayanan_ibu_bersalin::class, 'pemeriksaan_id');
    }

    public function form_pelayanan_ibu_nifas(){
        return $this->hasMany(Form_pelayanan_ibu_nifas::class, 'pemeriksaan_id');
    }

    public function form_pemeriksaan_lab(){
        return $this->hasMany(Form_pemeriksaan_lab::class, 'pemeriksaan_id');
    }

    public function form_pengawasan_minum_tablet(){
        return $this->hasMany(Form_pengawasan_minum_tablet::class, 'pemeriksaan_id');
    }

    public function form_riwayat_kehamilan_sebelumnya(){
        return $this->hasMany(Form_riwayat_kehamilan_sebelumnya::class, 'pemeriksaan_id');
    }

    public function form_riwayat_kehamilan_sekarang(){
        return $this->hasMany(Form_riwayat_kehamilan_sekarang::class, 'pemeriksaan_id');
    }


}
