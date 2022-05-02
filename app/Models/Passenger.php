<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'detail'
    ];

    protected $casts = [
        'detail' => 'array',
    ];


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
