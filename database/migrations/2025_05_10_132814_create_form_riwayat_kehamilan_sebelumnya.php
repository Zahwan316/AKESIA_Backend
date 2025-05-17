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
        Schema::create('form_riwayat_kehamilan_sebelumnya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->cascadeOnDelete();
            $table->integer('anak_ke');
            $table->string('apiah');
            $table->integer('umur_anak');
            $table->string('p_l');
            $table->string('bbl');
            $table->string('cara_persalinan');
            $table->string('penolong');
            $table->string('tempat_persalinan');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_riwayat_kehamilan_sebelumnya');
    }
};
