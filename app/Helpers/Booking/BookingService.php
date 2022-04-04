<?php

namespace App\Helpers\Booking;

use App\Models\Unbookable;
use App\Models\Waiting;
use Carbon\Carbon;

class BookingService {

    use BookingTrait;

    public function unbookableRoom($user_id = null, $room_id = null, $start_date = null, $end_date = null, $expiration = null)
    {
        $user = $user_id ?? auth('web')->user()->id;
        $room = $room_id ?? Booking::getRoom()->id;
        $start = $start_date ?? Booking::getCheckin();
        $end = $end_date ?? Booking::getCheckout();
        $expire = $expiration ?? Carbon::now()->addMinutes(15);

        $unbookable = Unbookable::where([['user_id', $user], ['start_date', $start], ['end_date', $end], ['expiration', '>=', Carbon::now()]])->first();

        if (is_null($unbookable)) {
            Unbookable::create([
                'user_id' => $user,
                'room_id' => $room,
                'start_date' => $start,
                'end_date' => $end,
                'expiration' => $expire,
            ]);
        }
    }
}