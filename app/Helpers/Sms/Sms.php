<?php

namespace App\Helpers\Sms;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'sms';
    }
}