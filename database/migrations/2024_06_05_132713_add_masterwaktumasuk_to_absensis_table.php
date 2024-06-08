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
        Schema::table('absensis', function (Blueprint $table) {
            $table->time('master_waktu_masuk')->nullable();
            $table->time('master_waktu_keluar')->nullable();
            $table->enum('status_absen_masuk', ['Sesuai', 'Terlambat'])->default('Sesuai');
            $table->unsignedBigInteger('ajuans_id')->nullable()->comment('untuk relasi ke dalam table ajuans');
            $table->string('jenis_ajuans',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            //
        });
    }
};
