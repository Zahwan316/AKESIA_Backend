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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibu_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bidan_id')->nullable()->constrained('bidans')->cascadeOnDelete();
            $table->foreignId('pelayanan_id')->constrained();
            $table->timestamp('tanggal_pendaftaran');
            $table->time('jam_pendaftaran');
            $table->string('status', 24);
            $table->text('keluhan');
            $table->string('nama_anak', 56);
            $table->integer('umur_anak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
