<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Log;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'is_blocked',
        'phone',
    ];

    protected $hidden = [
        'password'
    ];

    protected $table = 'admins';


    public function tokens()
    {
        return $this->morphMany(Token::class, 'tokenable');
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }


    // permission
    public function permissions()
    {
        return $this->morphToMany(Permission::class, 'permissionable');
    }
    public function roles()
    {
        return $this->morphToMany(Role::class, 'roleable');
    }
    public function hasRole($roles)
    {
        return !! $roles->intersect($this->roles)->all();
    }
    public function hasPermission($permission)
    {
        return $this->permissions->contains($permission) || $this->hasRole($permission->roles);
    }

}
