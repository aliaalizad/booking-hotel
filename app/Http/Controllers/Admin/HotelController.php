<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Booking\Booking;
use App\Http\Controllers\HotelController as BaseHotelController;
use App\Models\Booking as BookingModel;
use App\Models\Hotel;


class HotelController extends BaseHotelController {

    public $panel = 'admin';

    public function indexBookings(Hotel $hotel)
    {
        $bookings = Booking::getHotelBookings($hotel);

        return view('panels.admin.hotels.bookings.all', compact('hotel', 'bookings'));
    }

    public function showBookings(Hotel $hotel, BookingModel $booking)
    {
        $passengers = $booking->passengers->first()->detail;
        $payments = $booking->payments;

        return view('panels.admin.hotels.bookings.show', compact('hotel', 'booking', 'payments', 'passengers'));
    }


}