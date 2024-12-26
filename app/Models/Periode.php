<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Periode extends Model
{
    use HasFactory;

    protected $table = 'periodes';
    protected $primaryKey = 'id_periode';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_periode',
        'tgl_mulai',
        'tgl_selesai',
    ];
    

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id_periode');
    }
    
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_pengajuan');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];
}
