<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function validator()
    {
        $validator = Validator::make(request()->all(), [
            'dest' => ['required'],
            'checkin' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'checkout' => ['required', 'date_format:Y-m-d', 'after:today', 'after:checkin'],
            'adults' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {

            $failedRules = $validator->failed();

            // checkin and checkout
            if( isset($failedRules['checkin']) ) {
                if( isset($failedRules['checkout'])) {
                    $checkin = Carbon::now()->toDateString();
                    $checkout = Carbon::now()->addDay()->toDateString();
                } else {
                    $checkin = Carbon::now()->toDateString();
                    $checkout = request()->checkout;
                }
            } else {
                $checkin = Carbon::create(request()->checkin)->toDateString();
                $checkout = Carbon::create(request()->checkin)->addDay()->toDateString();
            }

            // dest
            if (isset($failedRules['dest'])) {
                $dest = 'tabriz';
            } else {
                $dest = request()->dest;
            }

            // adults
            if (isset($failedRules['adults'])) {
                $adults = 2;
            } else {
                $adults = request()->adults;
            }

        } else {
            $dest = request()->dest;
            $checkin = request()->checkin;
            $checkout = request()->checkout;
            $adults = request()->adults;
        }

        return [ $dest, $checkin, $checkout, $adults ];
    }

    public function proccess($destination = null, $checkin = null, $checkout = null, $adults = null)
    {
        [$dest, $checkin, $checkout, $adults] = $this->validator();

        if (! is_null($destination)) {
            $dest = $destination;
        }

        $rooms = Room::where('capacity', '>=', $adults)

            ->whereHas('hotel', function($query) use ($dest) {
            $query->where('city', $dest);
            })

            ->whereDoesntHave('bookings', function ($query) use ($checkin, $checkout) {
                $query->where([['checkin', '>=', $checkin], ['checkin', '<', $checkout]])
                    ->orWhere([['checkout', '>', $checkin], ['checkout', '<=', $checkout]])
                    ->orWhere([['checkin', '<', $checkin], ['checkout', '>', $checkout]]);
            })

        ->get();


        $hotels = collect([]);
        foreach($rooms as $room) {
            $hotels->push($room->hotel);
        }
        $hotels = $hotels->unique();


        return collect(['hotels' => $hotels, 'rooms' => $rooms]);

    }

    public function search()
    {
        $hotels = $this->proccess()->get('hotels');
        $rooms = $this->proccess()->get('rooms');

        return view('search', compact('hotels', 'rooms'));
    }


    public function hotel(Hotel $hotel)
    {
        $rooms = $this->proccess($hotel->city)->get('rooms')->where('hotel_id', $hotel->id)->sortBy('price');

        return view('hotel', compact('hotel', 'rooms'));
    }

}
