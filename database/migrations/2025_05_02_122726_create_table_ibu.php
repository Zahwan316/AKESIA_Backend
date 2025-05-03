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
        Schema::create('ibus', function (Blueprint $table) {
            $table->id(); // Auto-increment & Primary Key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->char('nik', 16);
            $table->char('golongan_darah', 4);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->tinyInteger('pendidikan')->unsigned();
            $table->tinyInteger('pekerjaan')->unsigned();
            $table->string('alamat_domisili', 250);
            $table->char('telepon', 13);
            $table->string('no_registrasi_kohort_ibu', 10)->nullable();
            $table->string('Nama_Keluarga', 100)->nullable();
            $table->unsignedSmallInteger('berat_badan', )->nullable();
            $table->unsignedSmallInteger('tinggi_badan', )->nullable();
            $table->unsignedSmallInteger('usia_kehamilan', )->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Ibus');
    }
};
