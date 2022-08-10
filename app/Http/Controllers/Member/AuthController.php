<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return to_route('member.dashboard');
    }

    public function dashboard()
    {
        return view('panels.member.dashboard');
    }

    public function showLoginForm()
    {
        return view('member.login');
    }

    public function login(Request $request)
    {

        $Validator = Validator::make($request->all(), [
            'username'  => ['required'],
            'password'  => ['required'],
        ])->Validated();

        
        if (Auth::guard('member')->attempt($Validator)) {

            Auth::guard('admin')->logout();
            Auth::guard('manager')->logout();
            Auth::guard('web')->logout();
            
            if (Auth::guard('member')->user()->is_blocked == 1) {
                Auth::guard('member')->logout();
                return back()->withErrors([
                    'loginError' => 'حساب کاربری شما مسدود شده است',
                ]);
            }

            $request->session()->regenerate();

            return to_route('member.dashboard');
        }

        return back()->withErrors([
            'loginError' => 'نام کاربری یا رمز عبور صحیح نیست',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return to_route('member.login');
    }
}
