<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Manager;
use App\Models\Member;

class Token extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'token',
        'tokenable_id',
        'tokenable_type',
        'type',
        'expired_at',
    ];


    
    protected $table = 'tokens';

    protected $hidden = [
        'token'
    ];

    public function ScopeClear(){
        Token::where('expired_at','<', now())->delete();
    }


    // relationships

    public function tokenable()
    {
        return $this->morphTo();
    }
}
