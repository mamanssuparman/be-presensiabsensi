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
        Schema::create('masterkalenders', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan')->comment('bulan menggunakan angka 1-12');
            $table->integer('tahun')->comment('tahun menggunakan angka');
            $table->integer('totalhariefektif')->comment('menampung total hari efektif bulan berjalaln');
            $table->enum('statusmasterkalenders', ['1', '2'])->default('1')->comment('1: Aktif, 2: Non Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterkalenders');
    }
};
