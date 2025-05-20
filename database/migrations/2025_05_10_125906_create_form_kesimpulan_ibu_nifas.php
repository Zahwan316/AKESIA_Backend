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
        Schema::create('form_kesimpulan_ibu_nifas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_id')->constrained('pemeriksaans')->cascadeOnDelete();
            $table->enum('keadaan_ibu', ['Sehat', 'Sakit', 'Meninggal']);
            $table->enum('komplikasi_nifas', ['Pendarahan', 'Infeksi', 'Hipertensi', 'Lain-lain']);
            $table->enum('keadaan_bayi', ['Sehat', 'Sakit', 'Kelainan Bawaan', 'Meninggal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_kesimpulan_ibu_nifas');
    }
};
