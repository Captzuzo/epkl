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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('id_laporan'); // Primary key id_laporan
            $table->unsignedBigInteger('nis'); // Foreign key ke tabel siswa
            $table->unsignedBigInteger('nip'); // Foreign key ke tabel pembimbing
            $table->string('file_laporan'); // File laporan (misal path file)
            $table->string('judul_laporan'); // Judul laporan
            $table->enum('status_evaluasi', ['setujui', 'tolak', 'menunggu'])->default('menunggu'); // Status evaluasi dengan default 'menunggu'
            $table->text('catatan_pembimbing')->nullable(); // Catatan dari pembimbing
            $table->dateTime('tgl_upload'); // Tanggal dan waktu upload laporan
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
        Schema::dropIfExists('laporan');
    }
};
