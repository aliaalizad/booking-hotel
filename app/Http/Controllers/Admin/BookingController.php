<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BookingController as BaseBookingController;
use Illuminate\Http\Request;

class BookingController extends BaseBookingController
{
    public $panel = 'admin';

}
