<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Hotel;
use App\Models\Manager;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;


trait ResourceControllerHelpers {

    // getX
    public function getMembers($manager=false)
    {
        $members = Member::query();

        // checkCurrent
        if ($manager) {
            $members = $this->getCurrentManager()->members();
        }

        // filter
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

        return $members->paginate(20);
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

    public function getContracts()
    {
        return Contract::paginate(20);
    }


    // getAllX
    public function getAllHotels($manager=false)
    {
        if ($manager) {
            return Hotel::where('manager_id', $this->getCurrentManager()->id)->get();
        }

        return Hotel::all();
    }

    public function getAllMembers()
    {
        return Member::all();
    }

    public function getAllManagers()
    {
        return Manager::all();
    }

    public function getAllContracts()
    {
        return Contract::all();
    }


    // getCurrentX
    public function getCurrentManager()
    {
        return Auth::guard('manager')->user();
    }
    
}