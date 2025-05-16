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
        Schema::create('form_pelayanan_ibu_nifas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->cascadeOnDelete();
            $table->string('klasifikasi_nifas_1')->nullable();
            $table->string('tindakan_nifas_1')->nullable();
            $table->date('tanggal_nifas_1')->nullable();
            $table->string('klasifikasi_nifas_2')->nullable();
            $table->string('tindakan_nifas_2')->nullable();
            $table->date('tanggal_nifas_2')->nullable();
            $table->string('klasifikasi_nifas_3')->nullable();
            $table->string('tindakan_nifas_3')->nullable();
            $table->date('tanggal_nifas_3')->nullable();
            $table->string('klasifikasi_nifas_4')->nullable();
            $table->string('tindakan_nifas_4')->nullable();
            $table->date('tanggal_nifas_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pelayanan_ibu_nifas');
    }
};
