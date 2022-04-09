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
    ];

    protected $table = 'hotels';

    // relationships
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
    
    public function members(){
        return $this->hasMany(Member::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }

}
