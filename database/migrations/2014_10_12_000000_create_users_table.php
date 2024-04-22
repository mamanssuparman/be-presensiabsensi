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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nuptk')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('notelepon')->nullable();
            $table->unsignedBigInteger('jabatansid');
            $table->text('alamat')->nullable();
            $table->enum('role', ['1', '2', '3'])->default('3')->comment('1: Kepala Sekolan, 2: Admin, 3: Users ');
            $table->text('fotos');
            $table->enum('statususers', ['1', '2'])->default('1')->comment('1: Aktif, 2:Non Aktif');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
