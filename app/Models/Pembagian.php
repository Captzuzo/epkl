<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembagian extends Model
{
    use HasFactory;
    
    protected $table = 'pembagians';
    protected $primaryKey = 'id_pembagian';
    protected $fillable = [
        'id_pengajuan',
        'nis',
        'nip',
        'id_instansi',
    ];
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }

        // Relasi Pembimbing dengan Siswa (bisa lewat Pembagian)
 // Dapatkan semua siswa yang dibimbing oleh pembimbing ini
 public function siswas()
 {
     return $this->hasManyThrough(Siswa::class, Pembagian::class, 'nip', 'nis', 'nip', 'nis');
 }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'nip');
    }

}
