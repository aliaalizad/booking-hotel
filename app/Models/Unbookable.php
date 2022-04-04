<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unbookable extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'start_date',
        'end_date',
        'expiration',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    protected $table = 'unbookable';

}

