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
        // $this->middleware('confirm')->only(['create', 'edit']);
    }

    public function index(Hotel $hotel)
    {
        $this->authorize('room-viewAny', $hotel);

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

        // conditions validation
        $request->validate([
            'conditions' => ['array'],
            'conditions.*' => ['array'],
            'conditions.titles.*' => ['string'],
            'conditions.answers.*' => ['boolean'],
            'conditions.values.*' => ['integer', 'max:100000000'],
            'conditions.changes.*' => ['in:==,+%,-%,++,--'],
        ],[
            'conditions.titles.*.string' => 'شروط قیمتی نامعتبر',
            'conditions.answers.*.boolean' => 'شروط قیمتی نامعتبر',
            'conditions.values.*.integer' => 'شروط قیمتی نامعتبر',
            'conditions.changes.*.in' => 'شروط قیمتی نامعتبر',
        ]);

        // conditions settings
        $conditions = [];
        if (isset($request->conditions['titles'])) {
            for ($i=0; $i < count($request->conditions['titles']) ; $i++) { 
                $conditions[$i] = [
                    'title' => $request->conditions['titles'][$i],
                    'answer' => $request->conditions['answers'][$i],
                    'value' => $request->conditions['values'][$i],
                    'change' => $request->conditions['changes'][$i],
                ];
            }
        }

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
            'conditions' => $conditions,
        ]);

        return to_route($path, $hotel->id);
    }

    public function edit(Hotel $hotel, Room $room)
    {
        $this->authorize('room-update', [$hotel, $room]);

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
        $this->authorize('room-update', [$hotel, $room]);

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


        // conditions validation
        $request->validate([
            'conditions' => ['array'],
            'conditions.*' => ['array'],
            'conditions.titles.*' => ['string'],
            'conditions.answers.*' => ['boolean'],
            'conditions.values.*' => ['integer', 'max:100000000'],
            'conditions.changes.*' => ['in:==,+%,-%,++,--'],
        ],[
            'conditions.titles.*.string' => 'شروط قیمتی نامعتبر',
            'conditions.answers.*.boolean' => 'شروط قیمتی نامعتبر',
            'conditions.values.*.integer' => 'شروط قیمتی نامعتبر',
            'conditions.changes.*.in' => 'شروط قیمتی نامعتبر',
        ]);

        // conditions settings
        $conditions = [];
        if (isset($request->conditions['titles'])) {
            for ($i=0; $i < count($request->conditions['titles']) ; $i++) { 
                $conditions[$i] = [
                    'title' => $request->conditions['titles'][$i],
                    'answer' => $request->conditions['answers'][$i],
                    'value' => $request->conditions['values'][$i],
                    'change' => $request->conditions['changes'][$i],
                ];
            }
        }



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
            'name' => $request->title,
            'capacity' => $request->capacity,
            'numbers' => $rooms,
            'price' => $request->price,
            'is_bookable' => $is_bookable,
            'conditions' => $conditions,
        ]);

        return to_route($path, $hotel->id);
    }
}
