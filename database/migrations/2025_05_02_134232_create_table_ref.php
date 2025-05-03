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
        Schema::create('Ref_Pendidikans', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->timestamps();
        });
        Schema::create('Ref_Pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->timestamps();
        });
        Schema::create('Ref_Provinsis', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->timestamps();
        });
        Schema::create('Ref_Kotas', function (Blueprint $table) {
            $table->id();
            $table->string('provinsi_id');
            $table->string('name',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_ref');
    }
};
