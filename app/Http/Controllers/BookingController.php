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

    public function showConfirmForm()
    {
        $room = Booking::getRoom();
        $passengers = Booking::getPassengers();
        $teacher = Booking::getTeacher();
        
        return view('reserve.confirm', compact('room', 'passengers', 'teacher'));
    }

    public function proccess() {
    }

    
}
