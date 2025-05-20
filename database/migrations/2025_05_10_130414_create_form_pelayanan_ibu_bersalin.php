<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_pelayanan_ibu_bersalin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->constrained('pemeriksaans')->cascadeOnDelete();
            $table->date('tanggal_persalinan');
            $table->time('jam_lahir');
            $table->string('umur_kehamilan');
            $table->enum('penolong_persalinan',['Dokter Kandungan', 'Dokter Umum', 'Bidan']);
            $table->enum('cara_persalinan',['Normal', 'Tindakan']);
            $table->enum('keadaan_ibu', [
                'sehat',
                'sakit',
                'perdarahan',
                'demam',
                'lokhia berbau',
                'lain-lain',
                'meninggal'
            ]);
            $table->enum('kb_pasca_persalinan', ['Ya', 'Tidak']);
            $table->text('keterangan_tambahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pelayanan_ibu_bersalin');
    }
};
