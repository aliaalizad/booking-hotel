<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\ManagerLoginRequest;
use Illuminate\Http\Request;

class ManagerLoginController extends Controller
{
    public function show()
    {
        return view('manager.login');
    }

    public function create(ManagerLoginRequest $request)
    {
        return redirect()->route('manager.dashboard');
    }
}
