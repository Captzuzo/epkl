<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class ModelHasRole extends Model
{
    use HasFactory;
    // Define the relationship with ModelHasRole
    protected $primaryKey = 'role_id';
     // Menentukan relasi dengan tabel permissions
    public function modelHasRoles()
    {
        return $this->hasMany(ModelHasRole::class);
    }

    // Define the many-to-many relationship with permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    // Define the relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class); // Foreign key role_id
    }

    // Define the polymorphic relationship with the model (such as User)
    public function model()
    {
        return $this->morphTo(); // If model_type is polymorphic (e.g., User)
    }

    // Define the relationship with User (if model_type is "App\Models\User")
    // Relasi ke model User (atau model lain tergantung context)
    public function user()
    {
        return $this->belongsTo(User::class, 'model_id'); // 'model_id' sebagai foreign key
    }
    // Mass assignable fields
    protected $fillable = [
        'role_id',
        'model_id',
        'model_type',
    ];
    


    
}
