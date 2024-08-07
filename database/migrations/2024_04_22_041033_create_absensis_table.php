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
            $table->date('tgl_absensi');
            $table->time('waktu_masuk')->nullable();
            $table->time('waktu_keluar')->nullable();
            $table->text('latitude_masuk')->nullable()->comment('untuk mendapatkan lokasi latitude pada saat absen masuk');
            $table->text('longitude_masuk')->nullable()->comment('untuk mendapatkan lokasi longitude pada saat absensi masuk');
            $table->text('foto_masuk')->nullable()->comment('untuk mendapatkan foto pada saat absensi masuk');
            $table->text('latitude_keluar')->nullable()->comment('untuk mendapatkan latitude pada saat absensi keluar');
            $table->text('longitude_keluar')->nullable()->comment('untuk mendapatkan longitude pada saat absensi keluar');
            $table->text('foto_keluar')->nullable()->comment('untuk mendapatkan foto pada saat absensi keluar');
            $table->double('jarak_absen_masuk')->nullable()->comment('Untuk menyimpan jarak absen masuk');
            $table->double('jarak_absen_keluar')->nullable()->comment('Untuk menyimpan jarak absen keluar');
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
