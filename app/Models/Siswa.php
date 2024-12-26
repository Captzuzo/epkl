<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Siswa extends Model
{
    use HasFactory, HasRoles;
    // Menentukan primary key yang berbeda (user_id)
    protected $primaryKey = 'nis';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'siswas';
    protected $fillable = [
        'nis', 
        'nama_siswa',
        'kelas', 
        'id_periode', 
        'id_jurusan', 
        'alamat', 
        'kota', 
        'ttl', 
        'no_telp', 
        'email', 
        'username', 
        'password',
    ];

    public function modelHasRoles()
     {
         return $this->hasMany(ModelHasRole::class);
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

    // public function pembagians()
    // {
    //     return $this->belongsTo(Pembagian::class, 'nis', 'nis');
    // }

    // Relasi dengan Pengajuan (Many-to-Many)
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'nis', 'nis');
    }

    // Relasi banyak ke banyak dengan Pengajuan
    public function pengajuans()
    {
        return $this->belongsToMany(Pengajuan::class, 'pengajuan_siswa', 'nis', 'pengajuan_id')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function pembagians()
    {
        return $this->hasOne(Pembagian::class, 'nis', 'nis');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
}
