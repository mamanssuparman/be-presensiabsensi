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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawais_id');
            $table->unsignedBigInteger('masterabsensis_id')->comment('Berelasi dengan master induk absensis');
            $table->unsignedBigInteger('masterkalenders_id')->comment('Untuk menentukan ketentuan absensi setiap bulannya');
            $table->date('tgl_absensi');
            $table->time('waktu_masuk');
            $table->time('waktu_keluar')->nullable();
            $table->text('latitude');
            $table->text('langitude');
            $table->text('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
