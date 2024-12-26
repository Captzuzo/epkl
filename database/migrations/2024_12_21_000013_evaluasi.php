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
        Schema::create('evaluasis', function (Blueprint $table) {
            $table->id('id_evaluasi'); // Primary key id_evaluasi
            $table->unsignedBigInteger('id_laporan'); // Foreign key ke tabel laporan
            $table->unsignedBigInteger('nis'); // Foreign key ke tabel siswa
            $table->unsignedBigInteger('nip'); // Foreign key ke tabel pembimbing
            $table->string('file_laporan'); // File laporan evaluasi (misal path file)
            $table->string('judul_laporan'); // Judul laporan evaluasi
            $table->enum('status_evaluasi', ['setujui', 'tolak', 'menunggu'])->default('menunggu'); // Status evaluasi dengan default 'menunggu'
            $table->text('catatan_pembimbing')->nullable(); // Catatan pembimbing, bisa kosong
            $table->dateTime('tgl_upload'); // Tanggal dan waktu upload laporan evaluasi
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
        Schema::dropIfExists('evaluasi');
    }
};
