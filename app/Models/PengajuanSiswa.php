<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSiswa extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_siswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nis',
        'id_jurusan',
        'id_instansi',
        'id_periode',
        'tgl_mulai',
        'status',
        'tgl_selesai'
    ];
     // Relasi ke model Siswa
    public function siswas()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    // Relasi ke model Jurusan
    public function jurusans()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    // Relasi ke model Instansi
    public function instansis()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }

    // Relasi ke model Periode
    public function periodes()
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id_periode');
    }
    public function siswapengajuan()
    {
        return $this->belongsToMany(Siswa::class, 'pengajuan_siswa', 'id_pengajuan', 'siswa_nis');
    }

}
