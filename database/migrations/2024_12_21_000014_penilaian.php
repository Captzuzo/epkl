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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id('id_penilaian'); // Primary key id_penilaian
            $table->unsignedBigInteger('nis'); // Foreign key ke tabel siswa
            $table->unsignedBigInteger('id_jurusan'); // Foreign key ke tabel jurusan
            $table->string('sekolah_asal')->default('SMK Negeri 3 Kudus'); // Sekolah asal dengan nilai default
            $table->unsignedBigInteger('id_instansi'); // Foreign key ke tabel instansi
            $table->text('alamat'); // Alamat instansi
            $table->date('tgl_mulai'); // Tanggal mulai penilaian
            $table->date('tgl_selesai'); // Tanggal selesai penilaian
            $table->integer('kedisiplinan'); // Nilai kedisiplinan
            $table->integer('kerjasama_inisiatif'); // Nilai kerjasama dan inisiatif
            $table->integer('kerajinan'); // Nilai kerajinan
            $table->integer('tanggung_jawab'); // Nilai tanggung jawab
            $table->integer('sikap'); // Nilai sikap
            $table->integer('prestasi'); // Nilai prestasi
            $table->integer('skill_kompetensi_keahlian'); // Nilai skill/kompetensi keahlian
            $table->integer('total_nilai'); // Total nilai dari semua aspek penilaian
            $table->decimal('rata_rata', 5, 2); // Rata-rata nilai
            $table->string('huruf_total'); // Huruf total berdasarkan total nilai
            $table->string('huruf_rata_rata'); // Huruf rata-rata berdasarkan rata-rata nilai
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
        Schema::dropIfExists('penilaian');
    }
};
