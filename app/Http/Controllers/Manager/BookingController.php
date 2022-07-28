<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\BookingController as BaseBookingController;
use Illuminate\Http\Request;

class BookingController extends BaseBookingController
{
    public $panel = 'manager';

}
