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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidan_id')->constrained('bidans')->cascadeOnDelete();
            $table->foreignId('ibu_id')->constrained('ibus')->cascadeOnDelete();
            $table->foreignId('pelayanan_id')->constrained('pelayanans')->cascadeOnDelete();
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->cascadeOnDelete();
            $table->integer('harga');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
