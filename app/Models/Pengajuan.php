<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

   // Tentukan tabel yang digunakan oleh model ini
   protected $table = 'pengajuans';

   // Tentukan kolom mana yang dapat diisi secara massal
   protected $fillable = [
       'nis',
       'id_jurusan',
       'id_instansi',
       'id_periode',
       'tgl_mulai',
       'tgl_selesai',
       'status',
   ];

   // Relasi banyak ke banyak dengan Siswa
   public function siswas()
   {
       return $this->belongsToMany(Siswa::class, 'pengajuan_siswa', 'pengajuan_id', 'nis')
                   ->withPivot('status')
                   ->withTimestamps();
   }

   // Relasi ke tabel Jurusan
   public function siswa()
   {
       return $this->belongsTo(Siswa::class, 'nis', 'nis');
   }

   // Relasi ke tabel Jurusan
   public function jurusan()
   {
       return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
   }
   
   
       // Relasi ke tabel Periode
       public function periode()
       {
           return $this->belongsTo(Periode::class, 'id_periode');
       }

   // Relasi dengan model Instansi
   public function instansi()
   {
       return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
   }



}
