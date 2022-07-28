<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index(Hotel $hotel)
    {
        $rooms = $hotel->rooms;

        return view('panels.' . $this->panel . '.hotels.rooms.all', compact('hotel', 'rooms'));
    }

    public function create(Hotel $hotel)
    {
        return view('panels.' . $this->panel . '.hotels.rooms.add', compact('hotel'));
    }

    public function store(Request $request, Hotel $hotel)
    {
        $rooms = collect(json_decode($request->rooms, true))->pluck('value')->toArray();

        $request->merge([
            'rooms' => $rooms,
        ]);

        $request->validate([
            'name' => ['required', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer'],
            'rooms' => ['required', 'array'],
            'rooms.*' => ['required', 'integer', 'distinct'],
        ]);

        // set is_bookable value
        $is_bookable = is_null($request->bookable) ? 0 : 1;

        // return an error if the numbers are already registered
        $pre_nums = Room::where('hotel_id', $hotel->id)->get()->flatMap(function($room){
            return $room->numbers;
        })->toArray();

        foreach ($rooms as $room) {
            if (in_array($room, $pre_nums)) {
                return redirect()->back()->withErrors('Some numbers already are registered !'); 
            }
        }

        $hotel->rooms()->create([
            'code' => Str::random(40),
            'name' => $request->name,
            'capacity' => $request->capacity,
            'numbers' => $rooms,
            'price' => $request->price,
            'is_bookable' => $is_bookable,
        ]);

        return to_route($this->panel . '.rooms.index', $hotel->id);
    }

    public function edit(Hotel $hotel, Room $room)
    {
        return view('panels.' . $this->panel . '.hotels.rooms.edit', compact('hotel', 'room'));
    }

    public function update(Request $request, Hotel $hotel, Room $room)
    {
        $rooms = collect(json_decode($request->rooms, true))->pluck('value')->toArray();

        $request->merge([
            'rooms' => $rooms,
        ]);

        $request->validate([
            'name' => ['required', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer'],
            'rooms' => ['required', 'array'],
            'rooms.*' => ['required', 'integer', 'distinct'],
        ]);

        // set is_bookable value
        $is_bookable = is_null($request->bookable) ? 0 : 1;

        // return an error if the numbers are already registered
        $pre_nums = Room::where('hotel_id', $hotel->id)->where('id', '!=', $room->id)->get()->flatMap(function($room){
            return $room->numbers;
        })->toArray();

        foreach ($rooms as $item) {
            if (in_array($item, $pre_nums)) {
                return redirect()->back()->withErrors('Some numbers already are registered !'); 
            }
        }

        $room->update([
            'code' => Str::random(40),
            'name' => $request->name,
            'capacity' => $request->capacity,
            'numbers' => $rooms,
            'price' => $request->price,
            'is_bookable' => $is_bookable,
        ]);

        return to_route($this->panel . '.rooms.index', $hotel->id);
    }
}
