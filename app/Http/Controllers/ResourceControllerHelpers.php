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

    public function getCurrentManager()
    {
        return Auth::guard('manager')->user();
    }
}