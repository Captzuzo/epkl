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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id('id_kunjungan'); // Primary key id_kunjungan
            $table->unsignedBigInteger('nis'); // Foreign key ke tabel siswa
            $table->unsignedBigInteger('nip'); // Foreign key ke tabel guru
            $table->unsignedBigInteger('id_instansi'); // Foreign key ke tabel instansi
            $table->text('catatan'); // Catatan mengenai kunjungan
            $table->date('tgl_kunjungan'); // Tanggal kunjungan
            $table->timestamps(); // Kolom tgl_buat dan tgl_update otomatis dengan timestamps()

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kunjungan');
    }
};
