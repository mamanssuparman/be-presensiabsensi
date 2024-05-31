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
        Schema::create('masterabsensis', function (Blueprint $table) {
            $table->id();
            $table->text('latitude');
            $table->text('langitude');
            $table->text('keterangan');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->integer('max_alpha')->default(3);
            $table->integer('max_terlambat')->default(20)->comment('waktu maximal terlambat dihitung pakai menit');
            $table->integer('jarakabsen')->default(50);
            $table->unsignedBigInteger('masterkalenders_id')->comment('Untuk menentukan ketentuan absensi setiap bulannya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterabsensis');
    }
};
