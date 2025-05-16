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
        Schema::create('pelayanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_layanan_id')->constrained('jenis_layanans')->onDelete('cascade');
            //$table->foreignId('form_id')->nullable()->constained('Ref_jenis_form');
            $table->string('nama')->nullable();
            $table->integer('harga')->nullable();
            //$table->integer('kuantitas');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Pelayanans');
    }
};
