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
        Schema::create('form_pemeriksaan_lab', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->cascadeOnDelete();
            $table->date('tanggal_pemeriksaan');
            $table->time('jam_pemeriksaan');
            $table->string('nama');
            $table->text('hasil');
            $table->date('tanggal_pelayanan');
            $table->time('jam_pelayanan');
            $table->string('soap');
            $table->string('penatalaksanaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pemeriksaan_lab');
    }
};
