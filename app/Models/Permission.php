<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Permission extends Model
{
    use HasFactory;


    // Menentukan relasi dengan tabel roles
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id');
    // }

    protected $fillable = [
        'name',
        'guard_name',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];


}
