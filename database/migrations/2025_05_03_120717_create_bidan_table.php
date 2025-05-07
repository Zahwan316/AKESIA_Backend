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
        Schema::create('bidans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //$table->foreignId('pendidikan_id')->constrained('Ref_Pendidikans');
            $table->foreignId('provinsi_id')->constrained('Ref_Provinsis');
            $table->foreignId('kota_id')->constrained('Ref_Kotas');
            $table->foreignId('image_id')->constrained('uploads');
            $table->foreignId('jenis_praktik_id')->constrained('ref_jenis_praktik');
            $table->string('tempat_bekerja', 120)->nullable();
            $table->string('status_keanggotaan_ibi');
            $table->string('nama_tempat_praktik', 120);
            $table->integer('no_STR')->unsigned()->nullable();
            $table->integer('no_SIP')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidan');
    }
};
