<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Token;


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
        'province',
        'contract_id'
    ];

    protected $hidden = [
        'password'
    ];

    protected $table = 'managers';


    // relationships
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
    public function members()
    {
        return $this->hasMany(Member::class);
    }
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function contract()
    {
        return $this->belongsToMany(Contract::class);
    }
}
