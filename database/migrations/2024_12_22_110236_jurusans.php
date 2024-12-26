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
        Schema::create('jurusans', function (Blueprint $table) {
            $table->id('id_jurusan'); // Primary key id_jurusan
            $table->string('nama_jurusan'); // Nama jurusan
            $table->timestamps(); // Kolom tgl_buat dan tgl_update otomatis dengan timestamps()
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusans');
    }
    
};
