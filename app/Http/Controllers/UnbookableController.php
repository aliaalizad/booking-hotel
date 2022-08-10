<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Unbookable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnbookableController extends Controller
{

    public function index(Request $request, Hotel $hotel)
    {
        $path = 'panels.' . $this->panel . '.hotels.unbookables.all';

        if ($this->panel == "member") {
            $path = 'panels.' . $this->panel . '.hotel.unbookables.all';
            $hotel = user('member')->hotel;
        }

        $unbookables = $hotel->rooms->flatMap(function($room){
            return $room->unbookables->where('expiration', '>=', Carbon::now());
        })->sortBy('start_date');

        return view($path, compact('unbookables', 'hotel'));
    }

    public function store(Request $request, Hotel $hotel)
    {
        $path = $this->panel . '.hotels.unbookables.index';

        if ($this->panel == "member") {
            $path = $this->panel . '.hotel.unbookables.index';
            $hotel = user('member')->hotel;
        }

        if ($request->has('length')) {

            $request->validate([
                'length' => ['required', 'integer', 'min:1'],
            ]);

            $start_date = Carbon::today();
            $end_date = Carbon::today()->addDays($request->length);

        } else {

            $request->validate([
                'date_from' => ['required', 'date', 'after_or_equal:today'],
                'date_to' => ['required', 'date', 'after:date-from'],
            ]);

            $start_date = $request->date_from;
            $end_date = $request->date_to;
        }

        $request->validate([
            'room' => ['required', Rule::in($hotel->rooms->flatMap(function($room){
                return $room->numbers;
            }))],
        ]);

        $room = Room::where('hotel_id', $hotel->id)->where('numbers', 'like', '%"' . $request->room . '"%')->first();

        Unbookable::create([
            'user_id' => null,
            'room_id' => $room->id,
            'room_number' => $request->room,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'expiration' => $end_date,
        ]);

        return to_route($path, $hotel->id);
    }

    public function delete(Request $request, Hotel $hotel, Unbookable $unbookable)
    {
        $unbookable->delete();

        $path = $this->panel . '.hotels.unbookables.index';

        if ($this->panel == "member") {
            $path = $this->panel . '.hotel.unbookables.index';
            $hotel = user('member')->hotel;
        }

        return to_route($path, $hotel->id);
    }
}
