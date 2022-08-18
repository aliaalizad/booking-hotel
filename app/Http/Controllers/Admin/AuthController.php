<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Sms\Sms;
use App\Helpers\Token\Token;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return to_route('admin.dashboard');
    }

    public function dashboard()
    {
        return view('panels.admin.dashboard');
    }

    public function getAuth()
    {
        request()->session()->forget('admin_username');
        return view('panels.admin.auth.auth');
    }
    
    public function postAuth(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $admin = Admin::whereUsername($request->username)->first();

        if ( is_null($admin) ) {
            return back()->withErrors(['login' => 'نام کاربری یا رمز عبور صحیح نیست']);
        }

        if (Hash::check($request->password, $admin->password)) {

            $request->session()->regenerate();

            session(['admin_username' => $admin->username]);

            $code = rand(100000, 999999);

            Token::make($admin, $code, 'login', 3);

            // Sms::sendCode($admin->phone, $code);

            Log::info($code);

            return to_route('admin.auth.getConfirm');
        }

        return back()->withErrors(['login' => 'نام کاربری یا رمز عبور صحیح نیست']);
    }

    public function getConfirm()
    {
        $admin = Admin::whereUsername(session()->get('admin_username'))->first();

        if ( ! session()->has('admin_username') or ! Token::has($admin, 'login')) {
            return to_route('admin.auth.getAuth');
        }

        return view('panels.admin.auth.confirm');
    }

    public function postConfirm(Request $request)
    {
        $admin = Admin::whereUsername(session()->get('admin_username'))->first();

        if ( ! session()->has('admin_username') or ! Token::has($admin, 'login')) {
            return to_route('admin.auth.getAuth');
        }

        $request->validate([
            'code' => ['required', 'numeric', 'digits:6'],
        ], [
            'code.numeric' => 'کد تایید باید یک عدد 6 رقمی باشد',
            'code.digits' => 'کد تایید باید یک عدد 6 رقمی باشد',
        ]);

        $token = Token::get($admin, 'login');

        if (is_null($token)) {
            return to_route('admin.auth.getAuth');
        }

        if (Hash::check($request->code, $token->token)) {
            $token->delete();

            Auth::guard('manager')->logout();
            Auth::guard('member')->logout();
            Auth::guard('web')->logout();

            Auth::guard('admin')->loginUsingId($admin->id);

            return to_route('admin.dashboard');
        }

        return back()->withErrors(['code' => 'کد وارد شده نامعتبر است']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return to_route('admin.auth.getAuth');
    }
}
