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
        Schema::create('form_bayi_saat_lahir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->cascadeOnDelete();
            $table->integer('anak_ke');
            $table->string('berat_lahir');
            $table->string('panjang_badan');
            $table->string('lingkar_kepala');
            $table->enum('jenis_kelamin', ['Tidak Diketahui', 'Laki-laki', 'Perempuan', 'Tidak Dapat Ditentukan', 'Tidak Mengisi']);
            $table->enum('kondisi_bayi_saat_lahir', [
                'Segera Menangis',
                'Menangis Beberapa Saat',
                'Tidak Menangis',
                'Seluruh Tubuh Kemerahan',
                'Anggota Gerak Kebiruan',
                'Seluruh Tubuh Biru',
                'Kelainan Bawaan',
                'Meninggal'
            ])->nullable();
            $table->enum('asuhan_bayi_baru_lahir', [
                'Inisiasi menyusu dini (IMD) dalam satu jam pertama kelahiran bayi',
                'Suntikan vitamin K1',
                'Salep mata antibiotika profilaksis',
                'Imunisasi HB0',
                'Keterangan tambahan',
            ])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_bayi_saat_lahir');
    }
};
