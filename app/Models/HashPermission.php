<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Role;

class HashPermission extends Model
{
    use HasFactory;
    // Menentukan kolom yang bisa diisi (fillable)
    protected $table = 'model_has_permissions';
    protected $primaryKey = 'permission_id';
    protected $fillable = [
        'permission_id',
        'model_type',
        'model_id',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Menentukan relasi jika diperlukan
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
