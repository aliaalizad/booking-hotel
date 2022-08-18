<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getAuth()
    {
        return view('panels.auth.auth');
    }

    public function postAuth(Request $request)
    {
        $request->validate([
            'role' => ['required', 'in:member,manager'],
            'username' => ['required'],
            'password' => ['required'],
        ],[
            'role.required' => 'نوع کاربری را انتخاب کنید',
            'role.in' => 'نوع کاربری مجاز نیست',
        ]);


        if ($request->role == 'member') {
            $member = Member::whereUsername($request->username)->first();

            if (is_null($member)) {
                return back()->withErrors(['login' => 'نام کاربری یا رمز عبور صحیح نیست']);
            }

            if (Hash::check($request->password, $member->password)) {
                $request->session()->regenerate();

                Auth::guard('admin')->logout();
                Auth::guard('manager')->logout();
                Auth::guard('web')->logout();

                Auth::guard('member')->loginUsingId($member->id);

                return to_route('member.dashboard');
            } else {
                return back()->withErrors(['login' => 'نام کاربری یا رمز عبور صحیح نیست']);
            }
        }

        if ($request->role == 'manager') {
            $manager = Manager::whereUsername($request->username)->first();

            if (is_null($manager)) {
                return back()->withErrors(['login' => 'نام کاربری یا رمز عبور صحیح نیست']);
            }

            if (Hash::check($request->password, $manager->password)) {
                $request->session()->regenerate();

                Auth::guard('admin')->logout();
                Auth::guard('member')->logout();
                Auth::guard('web')->logout();

                Auth::guard('manager')->loginUsingId($manager->id);

                return to_route('manager.dashboard');
            } else {
                return back()->withErrors(['login' => 'نام کاربری یا رمز عبور صحیح نیست']);
            }
        }

    }
}
