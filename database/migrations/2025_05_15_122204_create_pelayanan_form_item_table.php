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
        Schema::create('pelayanan_form_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelayanan_id')->constrained('pelayanans')->cascadeOnDelete();
            $table->foreignId('form_id')->constrained('Ref_jenis_form')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanan_form_item');
    }
};
