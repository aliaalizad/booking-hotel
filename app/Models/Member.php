<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Token;


class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'personnel_code',
        'manager_id',
        'password',
        'is_blocked',
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

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

}
