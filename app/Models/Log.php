<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'loggable_id',
        'loggable_type',
        'log_event_id',
        'detail',
    ];

    protected $casts = [
        'detail' => 'array',
    ];

 
    public function loggable()
    {
        return $this->morphTo();
    }

    public function log_events()
    {
        return $this->belongsTo(LogEvent::class);
    }

}
