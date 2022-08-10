<?php

namespace App\Http\Controllers;

use App\Helpers\Booking\Booking;
use App\Models\Booking as BookingModel;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    use ResourceControllerHelpers;

    public function index(Request $request)
    {
        // dd($request->all());
        $bookings = $this->getBookings();
        return view('panels.'. $this->panel . '.bookings.all', compact('bookings'));
    }

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
        Booking::freezeRoom();
        return Booking::newPayment();
    }

    public function paymentCallback()
    {
        return Booking::verifyPayment();
    }

    public function lastConfirmation()
    {
        $booking = Booking::pullBookingFromSession(request()->booking);
        $room = $booking->get('room');

        return Booking::isRoomBookable($room);
    }

}