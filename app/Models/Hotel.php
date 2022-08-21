<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'phone',
        'city_id',
        'address',
        'manager_id',
        'is_bookable',
        'min_bookable',
        'max_bookable',
        'bookable_until',
        'rules',
        'notification_mobiles',
        'coordinates',
    ];

    protected $table = 'hotels';

    protected $casts = [
        'rules' => 'array',
        'notification_mobiles' => 'array',
        'coordinates' => 'array',
    ];

    // relationships
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function members(){
        return $this->hasMany(Member::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }

}
