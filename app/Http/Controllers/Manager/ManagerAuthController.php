<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\ManagerLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManagerAuthController extends Controller
{
    public function index()
    {
        return view('manager.dashboard');
    }

    public function showLoginForm()
    {
        return view('manager.login');
    }

    public function login(ManagerLoginRequest $request)
    {
        if (Auth::guard('manager')->attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()->route('manager.dashboard');
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
    
        return redirect('/');
    }
}
