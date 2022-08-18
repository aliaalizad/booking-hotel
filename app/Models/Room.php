<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  use HasFactory;

  protected $fillable = [
    'code',
    'name',
    'capacity',
    'count',
    'price',
    'numbers',
    'hotel_id',
    'is_bookable',
    'conditions',
    'properties',
  ];

  protected $casts = [
    'numbers' => 'array',
    'conditions' => 'array',
    'properties' => 'array',
  ];
  
  public function bookings()
  {
    return $this->hasMany(Booking::class);
  }

  public function unbookables()
  {
    return $this->hasMany(Unbookable::class);
  }

  public function hotel()
  {
      return $this->belongsTo(Hotel::class);
  }

}
