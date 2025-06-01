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
            $table->foreignId('pemeriksaan_id')->constrained('pemeriksaans')->cascadeOnDelete();
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->time('jam_pemeriksaan')->nullable();
            $table->string('nama')->nullable();
            $table->text('hasil')->nullable();
            $table->date('tanggal_pelayanan')->nullable();
            $table->time('jam_pelayanan')->nullable();
            $table->string('soap')->nullable();
            $table->string('penatalaksanaan')->nullable();
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
