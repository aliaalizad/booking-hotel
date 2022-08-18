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

    public function logout(Request $request)
    {
        Auth::guard('manager')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return to_route('panel.getAuth');
    }
}
