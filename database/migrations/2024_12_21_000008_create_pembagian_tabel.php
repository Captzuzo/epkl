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
        Schema::create('pembagians', function (Blueprint $table) {
            $table->id('id_pembagian'); // Primary key id_pembagian
            $table->unsignedBigInteger('nis'); // Foreign key ke tabel siswa
            $table->unsignedBigInteger('nip'); // Foreign key ke tabel pembimbing
            $table->unsignedBigInteger('id_instansi'); // Foreign key ke tabel instansi
            $table->timestamps(); // Kolom tgl_buat otomatis dengan timestamps()
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembagian');
    }
};
