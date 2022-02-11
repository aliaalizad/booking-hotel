<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return to_route('manager.dashboard');
    }

    public function dashboard()
    {
        return view('panels.manager.dashboard');
    }

    public function showLoginForm()
    {
        return view('manager.login');
    }

    public function login(Request $request)
    {

        $Validator = Validator::make($request->all(), [
            'username'  => ['required'],
            'password'  => ['required'],
        ])->Validated();


        if (Auth::guard('manager')->attempt($Validator)) {
            
            Auth::guard('admin')->logout();
            Auth::guard('member')->logout();
            Auth::guard('web')->logout();


            $request->session()->regenerate();

            return to_route('manager.dashboard');
        }

        return back()->withErrors([
            'loginError' => 'نام کاربری یا رمز عبور صحیح نیست',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('manager')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return to_route('manager.login');
    }
}
