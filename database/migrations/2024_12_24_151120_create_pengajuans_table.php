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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nis'); // NIS siswa
            $table->unsignedBigInteger('id_jurusan'); // ID jurusan
            $table->unsignedBigInteger('id_instansi'); // ID instansi tempat PKL
            $table->unsignedBigInteger('id_periode'); // ID periode PKL
            $table->date('tgl_mulai'); // Tanggal mulai pengajuan PKL
            $table->enum('status', ['setujui', 'tolak', 'menunggu'])->default('menunggu'); // Status pengajuan
            $table->date('tgl_selesai')->nullable(); // Tanggal selesai PKL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
