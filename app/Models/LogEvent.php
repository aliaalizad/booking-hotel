<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEvent extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'parameters',
    ];


    protected $casts = [
        'parameters' => 'array',
    ];


    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
