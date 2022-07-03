<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\HotelController as BaseHotelController;
use App\Helpers\Booking\Booking;
use App\Models\Booking as BookingModel;
use App\Models\Hotel;

class HotelController extends BaseHotelController {

    public $panel = 'manager';

    public function indexBookings(Hotel $hotel)
    {
        $bookings = Booking::getHotelBookings($hotel);

        return view('panels.manager.hotels.bookings.all', compact('hotel', 'bookings'));
    }

    public function showBookings(Hotel $hotel, BookingModel $booking)
    {
        $passengers = $booking->passengers->first()->detail;
        $payments = $booking->payments;

        return view('panels.manager.hotels.bookings.show', compact('hotel', 'booking', 'payments', 'passengers'));
    }
}