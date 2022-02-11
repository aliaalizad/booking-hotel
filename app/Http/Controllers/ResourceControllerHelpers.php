<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Hotel;
use App\Models\Manager;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;


trait ResourceControllerHelpers {

    public function getAllMembers()
    {
        return Member::all();
    }

    public function getMembers($number=20)
    {
        $members = Member::query();

        if ($data = request('code')) {
            $members->where('personnel_code', $data);
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

        return $members->paginate($number);
    }

    public function getAllManagers()
    {
        return Manager::all();
    }

    public function getAllHotels()
    {
        return Hotel::all();
    }

    public function getAllContracts()
    {
        return Contract::all();
    }

    public function getContracts($number=20)
    {
        return Contract::paginate($number);
    }

    public function getCurrentManager()
    {
        return Auth::guard('manager')->user();
    }
}