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
        'created_at',
    ];

    public $timestamps = false;

    protected $table = 'tokens';

    protected $hidden = [
        'token'
    ];

    public function ScopeClear(){
        Token::where('expired_at','<', now())->delete();
    }


    // relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
