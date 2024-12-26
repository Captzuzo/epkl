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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id('id_absensi'); // Primary key id_absensi
            $table->unsignedBigInteger('nis'); // Foreign key ke tabel siswa
            $table->decimal('latitude', 10, 8)->nullable(); // Latitude dengan presisi untuk koordinat
            $table->decimal('longitude', 11, 8)->nullable(); // Longitude dengan presisi untuk koordinat
            $table->enum('status', ['hadir', 'izin', 'alpha'])->default('hadir'); // Status kehadiran
            $table->date('tgl_absen'); // Tanggal absen
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
        Schema::dropIfExists('absensi');
    }
};