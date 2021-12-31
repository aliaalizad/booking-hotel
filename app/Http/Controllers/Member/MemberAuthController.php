<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Member\MemberLoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberAuthController extends Controller
{
    public function index()
    {
        return view('member.dashboard');
    }

    public function showLoginForm()
    {
        return view('member.login');
    }

    public function login(MemberLoginRequest $request)
    {
        if (Auth::guard('member')->attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()->route('member.dashboard');
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
    
        return redirect('/');
    }
}
