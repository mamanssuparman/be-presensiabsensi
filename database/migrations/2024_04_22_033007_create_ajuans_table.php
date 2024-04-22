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
        Schema::create('ajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawais_id');
            $table->enum('jenis_ajuans', ['1', '2', '3'])->comment('1: Sakit, 2: Ijin, 3: Dinas Luar');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->text('tujuan')->nullable();
            $table->text('lampiran')->nullable();
            $table->enum('statusajuan',['1', '2', '3'])->default('1')->comment('1: Prosess, 2: Approve, 3: Tolak');
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuans');
    }
};
