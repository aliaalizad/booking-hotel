<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Booking\Booking;
use App\Http\Controllers\HotelController as BaseHotelController;
use App\Models\Booking as BookingModel;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HotelController extends BaseHotelController {

    public $panel = 'admin';


    public function indexRooms(Hotel $hotel)
    {
        $rooms = $hotel->rooms;

        return view('panels.admin.hotels.rooms.all', compact('hotel', 'rooms'));
    }

    public function createRooms(Hotel $hotel)
    {
        return view('panels.admin.hotels.rooms.add', compact('hotel'));
    }

    public function storeRooms(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
            'count' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer'],
        ]);

        // while(1) {
        //     $type = Str::random(4);
        //     if (! Room::where('type', $type)->exists()){
        //         break;
        //     }
        // }

        // foreach (range(1, $request->count) as $item) {
        //     $hotel->rooms()->create([
        //         'code' => Str::random(40),
        //         'name' => $request->name,
        //         'type' => $type,
        //         'capacity' => $request->capacity,
        //         'price' => $request->price,
        //     ]);
        // }

        $hotel->rooms()->create([
            'code' => Str::random(40),
            'name' => $request->name,
            'capacity' => $request->capacity,
            'count' => $request->count,
            'price' => $request->price,
        ]);

        return to_route('admin.hotels.rooms.index', $hotel->id);
    }

    public function editRooms(Hotel $hotel, Room $room)
    {
        return view('panels.admin.hotels.rooms.edit', compact('hotel', 'room'));
    }

    public function updateRooms(Request $request, Hotel $hotel, Room $room)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
            'count' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer'],
        ]);

        $room->update($data);

        return to_route('admin.hotels.rooms.index', $hotel->id);

    }



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