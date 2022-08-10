<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{

    public function __construct()
    {
        $this->middleware('confirm')->only(['create', 'edit']);
    }

    public function index(Hotel $hotel)
    {
        if ($this->panel == 'member') {
            $hotel = user('member')->hotel;
            $path = 'panels.member.hotel.rooms.all';
        } else {
            $path = 'panels.' . $this->panel . '.hotels.rooms.all';
        }

        $rooms = $hotel->rooms;
        return view($path , compact('hotel', 'rooms'));
    }

    public function create(Hotel $hotel)
    {
        if ($this->panel == 'member') {
            $hotel = user('member')->hotel;
            $path = 'panels.member.hotel.rooms.add';
        } else {
            $path = 'panels.' . $this->panel . '.hotels.rooms.add';
        }

        return view($path , compact('hotel'));
    }

    public function store(Request $request, Hotel $hotel)
    {
        $rooms = collect(json_decode($request->rooms, true))->pluck('value')->toArray();

        $request->merge([
            'rooms' => $rooms,
        ]);


        if ($this->panel == 'member') {
            $hotel = user('member')->hotel;
            $path = 'member.hotel.rooms.index';
        } else {
            $path = $this->panel . '.hotels.rooms.index';
        }

        $request->validate([
            'title' => ['bail', 'required', 'string', 'max:60'],
            'capacity' => ['bail', 'required', 'integer', 'min:1'],
            'rooms' => ['bail', 'required', 'array'],
            'rooms.*' => ['bail', 'required', 'integer', 'distinct'],
            'price' => ['bail', 'required', 'integer', 'min:100000', 'max:100000000'],
        ]);


        // set is_bookable value
        $is_bookable = is_null($request->bookable) ? 0 : 1;

        // return an error if the numbers are already registered
        $pre_nums = Room::where('hotel_id', $hotel->id)->get()->flatMap(function($room){
            return $room->numbers;
        })->toArray();

        foreach ($rooms as $room) {
            if (in_array($room, $pre_nums)) {
                return redirect()->back()->withErrors('برخی از اتاق ها قبلا ثبت شده است.'); 
            }
        }

        $hotel->rooms()->create([
            'code' => Str::random(40),
            'name' => $request->title,
            'capacity' => $request->capacity,
            'numbers' => $rooms,
            'price' => $request->price,
            'is_bookable' => $is_bookable,
        ]);

        return to_route($path, $hotel->id);
    }

    public function edit(Hotel $hotel, Room $room)
    {
        if ($this->panel == 'member') {
            $hotel = user('member')->hotel;
            $path = 'panels.member.hotel.rooms.edit';
        } else {
            $path = 'panels.' . $this->panel . '.hotels.rooms.edit';
        }

        return view($path, compact('hotel', 'room'));
    }

    public function update(Request $request, Hotel $hotel, Room $room)
    {
        $rooms = collect(json_decode($request->rooms, true))->pluck('value')->toArray();

        $request->merge([
            'rooms' => $rooms,
        ]);

        if ($this->panel == 'member') {
            $hotel = user('member')->hotel;
            $path = 'member.hotel.rooms.index';
        } else {
            $path = $this->panel . '.hotels.rooms.index';
        }

        $request->validate([
            'title' => ['bail', 'required', 'string', 'max:60'],
            'capacity' => ['bail', 'required', 'integer', 'min:1'],
            'rooms' => ['bail', 'required', 'array'],
            'rooms.*' => ['bail', 'required', 'integer', 'distinct'],
            'price' => ['bail', 'required', 'integer', 'min:100000', 'max:100000000'],
        ]);

        // set is_bookable value
        $is_bookable = is_null($request->bookable) ? 0 : 1;

        // return an error if the numbers are already registered
        $pre_nums = Room::where('hotel_id', $hotel->id)->where('id', '!=', $room->id)->get()->flatMap(function($room){
            return $room->numbers;
        })->toArray();

        foreach ($rooms as $item) {
            if (in_array($item, $pre_nums)) {
                return redirect()->back()->withErrors('برخی از اتاق ها قبلا ثبت شده است.'); 
            }
        }

        $room->update([
            'code' => Str::random(40),
            'name' => $request->title,
            'capacity' => $request->capacity,
            'numbers' => $rooms,
            'price' => $request->price,
            'is_bookable' => $is_bookable,
        ]);

        return to_route($path, $hotel->id);
    }
}
