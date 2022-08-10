<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Token;
use App\Models\Log;
use App\Models\Permission;

class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'phone',
        'manager_id',
        'password',
        'is_blocked',
        'hotel_id',
    ];

    protected $hidden = [
        'password'
    ];
    
    protected $table = 'members';


    // relationships
    public function tokens()
    {
        return $this->morphMany(Token::class, 'tokenable');
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
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
