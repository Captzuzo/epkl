<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $table = 'instansis';
    protected $primaryKey = 'id_instansi';
    // Menentukan nama tabel jika tidak mengikuti konvensi Laravel

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_instansi',
        'alamat',
        'no_telp',
        'kota',
        'latitude',
        'longitude',
    ];

    public function pengajuans()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan', 'id_pengajuan');
    }
}
