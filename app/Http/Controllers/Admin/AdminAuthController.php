<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {

        $Validator = Validator::make($request->all(), [
            'username'  => ['required'],
            'password'  => ['required'],
        ])->Validated();


        if (Auth::guard('admin')->attempt($Validator)) {
            
            Auth::guard('manager')->logout();
            Auth::guard('member')->logout();
            Auth::guard('web')->logout();

            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'loginError' => 'نام کاربری یا رمز عبور صحیح نیست',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login');
    }
}
