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

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return to_route('panel.getAuth');
    }
}
