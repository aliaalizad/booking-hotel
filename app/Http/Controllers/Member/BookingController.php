<?php

namespace App\Http\Controllers\Member;

use App\Helpers\Booking\Booking;
use App\Http\Controllers\BookingController as BaseBookingController;
use App\Models\Booking as BookingModel;
use App\Models\Hotel;
use Illuminate\Http\Request;

class BookingController extends BaseBookingController
{
    public $panel = 'member';

    public function calendar(Hotel $hotel)
    {
        $hotel = $this->getCurrentMember()->hotel;
        $bookings = Booking::getHotelBookings($hotel);

        return view('panels.member.hotel.bookings.all', compact('hotel', 'bookings'));
    }

    public function show(BookingModel $booking)
    {
        $passengers = $booking->passengers->first()->detail;
        $payments = $booking->payments;

        return view('panels.member.hotel.bookings.show', compact('booking', 'payments', 'passengers'));
    }

}
