<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'city',
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

}
