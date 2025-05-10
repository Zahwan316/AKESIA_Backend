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
        Schema::create('form_riwayat_kehamilan_sekarang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->cascadeOnDelete();
            $table->string('gravida');
            $table->string('partus');
            $table->string('rr/rt');
            $table->date('hpl');
            $table->string('hpht');
            $table->enum('muntah', ['Biasa', 'Terus Menerus']);
            $table->enum('pusing', ['Biasa', 'Terus Menerus']);
            $table->enum('nyeri_perut', ['Ada', 'Tidak']);
            $table->enum('nafsu_makan', ['Baik', 'Menurun']);
            $table->enum('pendarahan', ['Ada', 'Tidak']);
            $table->enum('riwayat_penyakit', [
                'Paru',
                'DM',
                'Jantung',
                'Epilepsi',
                'Hati',
                'Psikosis',
                'Ginjal',
                'Malaria'
            ]);
            $table->enum('riwayat_penyakit_keluarga', [
                'Kp',
                'DM',
                'Hipertensi',
                'Jantung',
                'Epilepsi',
                'Gemeli',
                'Psikosis',
                'Cacat Bawaan'
            ]);
            $table->enum('kebiasaan', [
                'Merokok',
                'Munuman keras',
                'Narkotik',
                'Obat penenang'
            ]);
            $table->enum('keluhan', [
                'Flour Albus',
                'Gatal',
                'Berbau',
                'Seperti Susu',
                'Busa Cair',
                'Tidak Ada',
            ]);
            $table->enum('pasangan_sexual_istri', [
                'Satu',
                'Lebih dari satu',
            ]);
            $table->enum('pasangan_sexual_suami', [
                'Satu',
                'Lebih dari satu',
            ]);
            $table->enum('mendiskusikan_hiv', [
                'Satu',
                'Lebih dari satu',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_riwayat_kehamilan_sekarang');
    }
};
