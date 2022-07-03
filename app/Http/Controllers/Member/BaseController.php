<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Booking\Booking;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\Booking as BookingModel;
use App\Models\Hotel;


class BaseController extends Controller
{
    use ResourceControllerHelpers;

    public function indexBookings(Hotel $hotel)
    {
        $hotel = $this->getCurrentMember()->hotel;
        $bookings = Booking::getHotelBookings($hotel);

        return view('panels.member.bookings.all', compact('hotel', 'bookings'));
    }

    public function showBookings(BookingModel $booking)
    {
        $passengers = $booking->passengers->first()->detail;
        $payments = $booking->payments;

        return view('panels.member.bookings.show', compact('booking', 'payments', 'passengers'));
    }
}
