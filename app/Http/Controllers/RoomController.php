<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            'rooms.*' => ['required', 'integer'],
        ]);

        $hotel->rooms()->create([
            'code' => Str::random(40),
            'name' => $request->name,
            'capacity' => $request->capacity,
            'count' => count($rooms),
            'numbers' => $rooms,
            'price' => $request->price,
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
            'rooms.*' => ['required', 'integer'],
        ]);

        $room->update([
            'code' => Str::random(40),
            'name' => $request->name,
            'capacity' => $request->capacity,
            'count' => count($rooms),
            'numbers' => $rooms,
            'price' => $request->price,
        ]);

        return to_route($this->panel . '.rooms.index', $hotel->id);

    }
}
