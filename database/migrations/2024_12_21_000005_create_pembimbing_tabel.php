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
        Schema::create('pembimbings', function (Blueprint $table) {
            $table->bigInteger('nip')->primary(); // Primary key NIP
            $table->string('nama_guru');
            $table->string('email')->unique();
            $table->unsignedBigInteger('id_jurusan'); // Foreign key ke tabel jurusan
            $table->string('no_telp');
            $table->string('username')->unique();
            $table->string('password');
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
        Schema::dropIfExists('pembimbing');
    }
};