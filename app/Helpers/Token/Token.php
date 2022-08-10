<?php

namespace App\Helpers\Token;

use Illuminate\Support\Facades\Facade;

class Token extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'token';
    }
}
