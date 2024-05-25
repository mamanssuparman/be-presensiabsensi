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
            $table->text('latitude_masuk')->comment('untuk mendapatkan lokasi latitude pada saat absen masuk');
            $table->text('longitude_masuk')->nullable()->comment('untuk mendapatkan lokasi longitude pada saat absensi masuk');
            $table->text('foto_masuk')->comment('untuk mendapatkan foto pada saat absensi masuk');
            $table->text('latitude_keluar')->nullable()->comment('untuk mendapatkan latitude pada saat absensi keluar');
            $table->text('longitude_keluar')->nullable()->comment('untuk mendapatkan longitude pada saat absensi keluar');
            $table->text('foto_keluar')->nullable()->comment('untuk mendapatkan foto pada saat absensi keluar');
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
