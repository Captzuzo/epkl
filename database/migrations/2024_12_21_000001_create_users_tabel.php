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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // Primary key user_id
            $table->unsignedBigInteger('nis')->nullable(); // Foreign key ke tabel siswa (nullable)
            $table->unsignedBigInteger('nip')->nullable(); // Foreign key ke tabel guru (nullable)
            $table->string('nama');
            $table->string('no_telp');
            $table->string('email'); // Kolom email yang unik
            $table->string('username'); // Kolom username yang unik
            $table->string('password');
            $table->enum('hak_akses', ['admin', 'guru', 'siswa']); // Hak akses dengan enum
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Drop tabel users jika migrasi dibatalkan
    }
};
