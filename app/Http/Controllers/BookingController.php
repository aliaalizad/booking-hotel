<?php

namespace App\Http\Controllers;

use App\Helpers\Booking\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function searchResults()
    {
        $hotels = Booking::getHotels();
        $rooms = Booking::getRooms();

        return view('search', compact('hotels', 'rooms'));
    }


    public function singleHotel()
    {
        Booking::getHotel();
        $rooms = Booking::getRooms()->sortBy('price');

        return view('hotel', compact('rooms'));
    }


    public function showPassengersForm()
    {
        $room = Booking::getRoom();
        return view('reserve.passengers', compact('room'));
    }


    public function proccess()
    {
        $booking = Booking::putBookingToSession();
        return to_route('reserve.confirm', ['booking' => $booking->get('id')] );
    }


    public function showConfirmForm()
    {
        $booking = Booking::pullBookingFromSession(request()->booking);


        return view('reserve.confirm', compact('booking'));
    }


    public function payment() 
    {
        if ( ! $this->lastConfirmation() ){
            return to_route('home');
        }

        $booking = Booking::pullBookingFromSession(request()->booking);

        Booking::newBooking($booking);

        Booking::unbookable();

        Booking::newPayment();

    }

    public function paymentCallback()
    {
        Booking::verifyPayment();
    }

    public function lastConfirmation()
    {
        $booking = Booking::pullBookingFromSession(request()->booking);
        $room = $booking->get('room');

        return Booking::isRoomBookable($room->id);
    }
}