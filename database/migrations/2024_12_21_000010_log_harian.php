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
        Schema::create('log_harians', function (Blueprint $table) {
            $table->id('id_logharian'); // Primary key id_logharian
            $table->unsignedBigInteger('nis'); // Foreign key ke tabel siswa
            $table->text('kegiatan'); // Deskripsi kegiatan
            $table->timestamps(); // Kolom tgl_buat dan tgl_edit otomatis dengan timestamps()

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_harian');
    }
};
