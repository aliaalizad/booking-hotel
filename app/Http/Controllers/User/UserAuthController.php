<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserAuthController extends Controller
{

    public function index()
    {
        return view('user.profile');
    }

    
    public function showLoginForm()
    {
        return view('user.login');
    }


    public function login(UserLoginRequest $request)
    {
    if (Auth::guard('web')->attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()->route('user.profile');
        }

        return back()->withErrors([
            'loginError' => 'ایمیل یا رمز عبور صحیح نیست',
        ]);
    }


    public function showRegisterForm()
    {
        return view('user.register');
    }


    public function register(UserRegisterRequest $request)
    {
        $user = new User();
        $user->create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);
        
        return redirect()->route('user.login');
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

}

