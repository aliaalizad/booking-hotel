<?php

namespace App\Helpers\Booking;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Unbookable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

trait BookingTrait {

    private $room;
    private $rooms;
    private $hotel;
    private $hotels;
    private $checkin;
    private $checkinJalali;
    private $checkout;
    private $checkoutJalali;
    private $length;
    private $adults;
    private $dest;
    private $teacher;
    private $passengers;




    // validators
    private function dateValidator()
    {
        $validator = Validator::make(request()->all(), [
            'checkin' => ['required', 'date', 'after_or_equal:today'],
            'checkout' => ['required', 'date', 'after:today', 'after:checkin'],
        ]);

        if ($validator->fails()) {

            $failedRules = $validator->failed();

            if( isset($failedRules['checkin']) ) {
                if( isset($failedRules['checkout'])) {
                    $checkin = Carbon::now()->toDateString();
                    $checkout = Carbon::now()->addDay()->toDateString();
                } else {
                    $checkin = Carbon::now()->toDateString();
                    $checkout = request()->checkout;
                }
            } else {
                if( isset($failedRules['checkout'])) {
                    $checkin = request()->checkin;
                    $checkout = Carbon::create($checkin)->addDay()->toDateString();
                } else {
                    $checkin = request()->checkin;
                    $checkout = request()->checkout;
                }
            }

        } else {
            $checkin = request()->checkin;
            $checkout = request()->checkout;
        }

        $this->checkin = $checkin;
        $this->checkout = $checkout;
        $this->length = Carbon::parse($checkout)->diffInDays(Carbon::parse($checkin));
        $this->checkinJalali = verta(Carbon::parse($checkin))->addMinutes(270)->format('Y/m/d');
        $this->checkoutJalali = verta(Carbon::parse($checkout))->addMinutes(270)->format('Y/m/d');
    }

    private function adultsValidator()
    {

        $validator = Validator::make(request()->all(), [
            'adults' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            $adults = 2;
        } else {
            $adults = request()->adults;
        }

        if ( ! is_null($this->room) && $adults > $this->room->capacity ){
            $adults = $this->room->capacity;
        }

        // if (! is_null($this->passengers) && $this->passengers->count() != $adults) {
        //     $adults = min([$this->passengers->count(), $adults]);
        // }

        $this->adults = $adults;
    }

    private function destValidator()
    {

        if (request()->has('dest')) {
            $dest = request()->dest;

        } else {

            if (! is_null($this->hotel)) {
                $dest = $this->hotel->city;
            } else {
                $dest = Hotel::find(1)->city;
            }
    
            if (! is_null($this->room)) {
                $dest = $this->room->hotel->city;
            }
        }
        $this->dest = $dest;
    }

    private function roomValidator()
    {
        if (request()->has('room')) {
            $room_code = request()->room;
        } else {
            $room_code = null;
        }
        $this->room = Room::where('code', $room_code)->firstOrFail();
    }

    private function hotelValidator()
    {
        if (request()->has('hotel')) {
            $hotel_code = request()->hotel;
        } else {
            $hotel_code = null;
        }
        $this->hotel = Hotel::where('code', $hotel_code)->firstOrFail();
    }

    private function passengersValidator()
    {
        if (request()->has('passengers')) {
            $validator = Validator::make(request()->all(), [
                'passengers' => ['required', 'array', 'size:3' ],
                'passengers.*.first_name' => ['required'],
                'passengers.*.last_name' => ['required'],
                'passengers.*.national_code' => ['required'],
                'passengers.1.phone' => ['required'],
            ])->validated();
            
            session( ['passengers' => $validator['passengers'] ]);

            return count($validator['passengers']) < $this->adults ? abort(400) : $this->passengers = $validator['passengers'];
        }
        
        if (session()->has('passengers')) {
            return count(session()->get('passengers')) < $this->adults ? abort(400) : $this->passengers = session()->get('passengers');
        }

        return abort(400);
    }

    private function teacherValidator()
    {
        if (request()->has('teacher')) {
            $validator = Validator::make(request()->all(), [
                'teacher.first_name' => ['required'],
                'teacher.last_name' => ['required'],
                'teacher.national_code' => ['required'],
                'teacher.personnel_code' => ['required'],
            ])->validated();
            
            session( ['teacher' => $validator['teacher'] ]);

            return $this->teacher = $validator['teacher'];
        }
        
        if (session()->has('teacher')) {
            return $this->teacher = session()->get('teacher');
        }

        return abort(404);
    }

    // engines
    private function roomEngine()
    {
        $this->dateValidator();
        $this->adultsValidator();
        $this->destValidator();
        
        $rooms = Room::where('capacity', '>=', $this->adults)

            ->whereHas('hotel', function($query) {
            $query->where('city', $this->dest);
            })

            ->whereDoesntHave('bookings', function ($query) {
                $query->where([['checkin', '>=', $this->checkin], ['checkin', '<', $this->checkout]])
                    ->orWhere([['checkout', '>', $this->checkin], ['checkout', '<=', $this->checkout]])
                    ->orWhere([['checkin', '<', $this->checkin], ['checkout', '>', $this->checkout]]);
            })

            ->whereDoesntHave('unbookable', function ($query) {
                $query->where([['start_date', '>=', $this->checkin], ['start_date', '<', $this->checkout], ['expiration', '>=', Carbon::now()]])
                    ->orWhere([['end_date', '>', $this->checkin], ['end_date', '<=', $this->checkout], ['expiration', '>=', Carbon::now()]])
                    ->orWhere([['start_date', '<', $this->checkin], ['end_date', '>', $this->checkout], ['expiration', '>=', Carbon::now()]]);
        })
        ->get();

        $this->rooms = $rooms;
    }

    private function hotelEngine() 
    {
        $hotels = collect([]);

        foreach($this->getRooms() as $room) {
            $hotels->push($room->hotel);
        }

        $hotels = $hotels->unique();

        $this->hotels = $hotels;
    }

    public function getPassengers()
    {
        $this->passengersValidator();
        return $this->passengers;
    }

    public function getTeacher()
    {
        $this->teacherValidator();
        return $this->teacher;
    }

    public function isRoomBookable($room = null)
    {

        if (!is_null($room)) {
            $this->room = Room::find($room);
        } else {
            $this->roomValidator();
        }

        $this->roomEngine();

        $condition1 = $this->rooms->contains($this->room); // bookable for all users
        $condition2 = ( Unbookable::where([ ['user_id', auth('web')->user()->id], ['room_id', $this->room->id], ['start_date', $this->checkin], ['end_date', $this->checkout], ['expiration', '>=', Carbon::now()] ])->get() )->isNotEmpty(); // bookable just for current user

        if ( $condition1 || $condition2 ) {
            return true;
        }

        return false;
    }

    public function getRoom()
    {
        if ($this->isRoomBookable()) {
            return $this->room;
        }
        return abort(404);
    }

    public function getRooms()
    {
        $this->roomEngine();

        $rooms = $this->rooms->unique(function ($item) {
            return $item['hotel_id'].$item['type'];
        });

        return $rooms;
    }


    public function getHotel()
    {
        $this->hotelValidator();
        return $this->hotel;
    }

    public function getHotels()
    {
        $this->hotelEngine();
        return $this->hotels;
    }


    public function getCheckin()
    {
        $this->dateValidator();
        return $this->checkin;
    }

    public function getCheckinJalali()
    {
        $this->dateValidator();
        return $this->checkinJalali;
    }

    public function getCheckout()
    {
        $this->dateValidator();
        return $this->checkout;
    }

    public function getCheckoutJalali()
    {
        $this->dateValidator();
        return $this->checkoutJalali;
    }

    public function getLength()
    {
        $this->dateValidator();
        return $this->length;
    }

    public function getAdults()
    {
        $this->adultsValidator();
        return $this->adults;
    }




    public function getDest()
    {
        $this->destValidator();
        return $this->dest;
    }
}