<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    // Menentukan primary key yang berbeda (id)
    protected $primaryKey = 'id';


        public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id'); // Sesuaikan dengan nama foreign key yang tepat
    }

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'id'); // Sesuaikan dengan nama foreign key yang tepat
    }

    // Tentukan kolom yang digunakan untuk login
    public function getAuthIdentifierName()
    {
        return 'username'; // Menentukan agar menggunakan kolom 'username'
    }

    public function getAuthPassword()
    {
        return $this->password;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nis', 
        'nip', 
        'nama', 
        'no_telp', 
        'email', 
        'username', 
        'password', 
    ];

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

     // Contoh metode untuk memeriksa peran user
     public function checkUserRole($role)
     {
         return $this->hasRole($role);
     }
}
