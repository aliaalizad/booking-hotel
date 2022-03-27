<?php

namespace App\Helpers\Booking;

use Illuminate\Support\Facades\Facade;

class Booking extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'booking';
    }
}