<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function showBooking(Booking $booking)
    {
        $this->authorize('booking-view', [$booking->room->hotel, $booking]);

        $passengers = $booking->passengers->first()->detail;
        $payments = $booking->payments;

        return view('user.show-booking', compact('booking', 'passengers', 'payments'));
    }
}
