<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRegisterRequest;
use App\Models\User;

class UserRegisterController extends Controller
{
    public function show()
    {
        return view('user.register');
    }

    public function create(UserRegisterRequest $request)
    {
        $user = new User();
        $user->create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => request()->password,
        ]);
    }}
