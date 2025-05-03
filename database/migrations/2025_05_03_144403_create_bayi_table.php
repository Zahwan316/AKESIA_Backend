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
        Schema::create('bayis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ibu_id')->constrained()->cascadeOnDelete();
            $table->string('nama_lengkap', 100);
            $table->char('jenis_kelamin', 2);
            $table->char('nik',16)->unique()->nullable();
            $table->char('golongan_darah', 4)->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->char('no_akta_kelahiran')->unique()->nullable();
            $table->char('no_registrasi_kohort_bayi')->unique()->nullable();
            $table->char('no_registrasi_kohort_balita')->unique()->nullable();
            $table->char('no_catatan_medik_rs')->unique()->nullable();
            $table->integer('anak_ke')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayi');
    }
};
