<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jurusan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_jurusan',
    ];
    // Model Jurusan.php ke jurusan
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id_jurusan');
    }
    
    public function pembimbings()
    {
        return $this->hasMany(Pembimbing::class, 'id_jurusan');
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
