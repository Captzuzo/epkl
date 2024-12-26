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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id('nis');
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->unsignedBigInteger('id_periode');
            $table->unsignedBigInteger('id_jurusan');
            $table->string('alamat');
            $table->string('kota');
            $table->date('ttl');
            $table->string('no_telp');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
