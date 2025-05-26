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
        Schema::create('form_pemeriksaan_umum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->constrained('pemeriksaans')->cascadeOnDelete();
            $table->string('bentuk_tubuh');
            $table->foreignId('kesadaran_id')->constrained('Ref_Kesadaran');
            $table->string('mata');
            $table->string('leher');
            $table->string('payudara');
            $table->string('paru');
            $table->string('jantung');
            $table->string('hati');
            $table->decimal('suhu_badan');
            $table->string('genetalia');
            $table->integer('tinggi_badan');
            $table->string('berat_badan');
            $table->text('soap')->nullable();
            $table->date('tanggal_kontrol_kembali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pemeriksaan_umum');
    }
};
