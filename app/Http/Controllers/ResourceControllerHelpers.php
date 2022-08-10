<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Manager;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;


trait ResourceControllerHelpers {

    // getX
    public function getMembers()
    {
        $members = Member::query();

        // checkCurrent
        if (guard('manager')) {
            $members = $this->getCurrentManager()->members();
        }

        // filter
        if ($data = request('code')) {
            $members->where('username', $data);
        }
        if ($data = request('name')) {
            $members->where('name', 'LIKE', "%$data%");
        }
        if ($data = request('status')) {
            if ( $data =='active' ) {
                $members->where('is_blocked', 0);
            }
            if ( $data =='inactive' ) {
                $members->where('is_blocked', 1);
            }
        }
        if ($data = request('manager')) {
            $members->where('manager_id', $data);
        }
        if ($data = request('hotel')) {
            $members->where('hotel_id', $data);
        }

        return $members->paginate(20);
    }

    public function getHotels()
    {
        $hotels = Hotel::query();

        // checkCurrent
        if (guard('manager')) {
            $hotels = $this->getCurrentManager()->hotels();
        }

        // filter
        if ($data = request('code')) {
            $hotels->where('username', $data);
        }
        if ($data = request('name')) {
            $hotels->where('name', 'LIKE', "%$data%");
        }
        if ($data = request('status')) {
            if ( $data =='active' ) {
                $hotels->where('is_blocked', 0);
            }
            if ( $data =='inactive' ) {
                $hotels->where('is_blocked', 1);
            }
        }
        if ($data = request('manager')) {
            $hotels->where('manager_id', $data);
        }
        if ($data = request('hotel')) {
            $hotels->where('hotel_id', $data);
        }

        return $hotels->paginate(20);
    }

    public function getManagers()
    {
        $managers = Manager::query();

        // filter
        if ($data = request('username')) {
            $managers->where('username', $data);
        }
        if ($data = request('name')) {
            $managers->where('name', 'LIKE', "%$data%");
        }
        if ($data = request('phone')) {
            $managers->where('phone', $data);
        }
        if ($data = request('province')) {
            $managers->where('province', 'LIKE', "%$data%");
        }
        if ($data = request('status')) {
            if ( $data =='active' ) {
                $managers->where('is_blocked', 0);
            }
            if ( $data =='inactive' ) {
                $managers->where('is_blocked', 1);
            }
        }
        if ($data = request('contract')) {
            $managers->where('contract_id', $data);
        }

        return $managers->paginate(20);
    }

    public function getBookings() {

        $bookings = Booking::query();

        $bookings->where('status', 'paid');

        if (guard('manager')) {
            $bookings->whereHas('room', function($room){
                $room->whereHas('hotel', function($hotel) {
                    $hotel->where('manager_id', user('manager')->id);
                });
            });
        }

        if (guard('member')) {
            $bookings->whereHas('room', function($room){
                $room->whereHas('hotel', function($hotel) {
                    $hotel->where('id', user('member')->hotel->id);
                });
            });
        }


        // filter
        if ($data = request('voucher')) {
            $bookings->where('voucher', $data);
        }

        if ($data = request('book-from')) {
            $bookings->where('created_at', '>=', $data);
        }

        if ($data = request('book-to')) {
            $bookings->where('created_at', '<=', $data);
        }

        if ($data = request('checkin-from')) {
            $bookings->where('checkin', '>=', $data);
        }

        if ($data = request('checkin-to')) {
            $bookings->where('checkin', '<=', $data);
        }

        if ($data = request('hotels')) {
            $bookings->whereHas('room', function($room) use ($data){
                $room->where('hotel_id', $data);
            });
        }

        if ($data = request('amount-from')) {
            $bookings->where('amount', '>=', $data);
        }

        if ($data = request('amount-to')) {
            $bookings->where('amount', '<=', $data);
        }

        return $bookings->orderBy('created_at', 'desc')->paginate(50);
    }


    public function getAllMembers()
    {
        return Member::all();
    }

    public function getAllManagers()
    {
        return Manager::all();
    }

    public function getAllHotels()
    {
        return Hotel::all();
    }

    public function getCurrentManager()
    {
        return Auth::guard('manager')->user();
    }

    public function getCurrentMember()
    {
        return Auth::guard('member')->user();
    }

}