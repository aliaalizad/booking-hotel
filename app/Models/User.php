<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Token;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'is_activated',
        'state_id',
        'national_code',
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

    protected $table = 'users';


    public function ScopeClear()
    {
        User::where('is_active', 0)->delete();
    }

    public function tokens()
    {
        return $this->morphMany(Token::class, 'tokenable');
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
