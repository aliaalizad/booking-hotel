<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Token;
use App\Models\Log;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Manager extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'is_blocked',
        'phone',
        'email',
        'city_id',
        'bank_account',
        'commission',
        'thirdParty_commission',
    ];

    protected $hidden = [
        'password'
    ];

    protected $table = 'managers';


    public function bankAccount(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Str::replaceFirst('IR', null, $value),
            set: fn ($value) => 'IR' . $value,
        );
    }

    // relationships
    public function tokens()
    {
        return $this->morphMany(Token::class, 'tokenable');
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
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
