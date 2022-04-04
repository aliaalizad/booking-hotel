<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'checkin',
        'checkout',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}
