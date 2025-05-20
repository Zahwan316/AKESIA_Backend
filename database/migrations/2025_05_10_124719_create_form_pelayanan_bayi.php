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
        Schema::create('form_pelayanan_bayi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->constrained('pemeriksaans')->cascadeOnDelete();
            $table->string('nama_bayi');
            $table->integer('umur_bayi');
            $table->string('jenis_kelamin_bayi');
            $table->string('booking_layanan');
            $table->string('keterangan_kondisi_bayi');
            $table->foreignId('tambahan_layanan_id')->nullable()->constrained('tambahan_layanans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pelayanan_bayi');
    }
};
