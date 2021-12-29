<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;

class UserLoginController extends Controller
{
    public function show()
    {
        return view('user.login');
    }

    public function create(UserLoginRequest $request)
    {
        return redirect()->route('user.profile');
    }
}
