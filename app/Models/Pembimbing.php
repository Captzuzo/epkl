<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Pembimbing extends Model
{
    use HasFactory;
    // Menentukan primary key yang berbeda (user_id)
    protected $primaryKey = 'nip';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'nama_guru',
        'email',
        'id_jurusan',
        'no_telp',
        'username',
        'password',
    ];

    // Relasi ke tabel Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    // public function pembagians()
    // {
    //     return $this->belongsTo(Pembagian::class, 'id_pembagian');
    // }
    // Relasi Pembimbing dengan Pembagian (Siswa yang dibimbing oleh Pembimbing)
    public function pembagians()
    {
        return $this->hasMany(Pembagian::class, 'nip');
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
