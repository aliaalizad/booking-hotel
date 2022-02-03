<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fee',
    ];

    protected $table = 'contracts';

    // relationships
    public function managers()
    {
        return $this->hasMany(Manager::class);
    }
}
