<?php

namespace App\Http\Controllers\User;

use App\Helpers\Token\Token;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    public function profile()
    {
        $bookings = user()->bookings()->where('status', 'paid')->orderBy('created_at', 'desc')->paginate();

        return view('user.dashboard', compact('bookings'));
    }

    public function getAuth()
    {
        request()->session()->forget('user_mobile');
        request()->session()->forget('new_user_mobile');
        request()->session()->forget('new_user_mobile_confirmed');
        request()->session()->forget('new_user_register_time');

        if (! session()->has('url.intended')) {
            session()->forget('url.intended');
            session()->put('url.intended', url()->previous());
        }

        return view('user.auth');
    }

    public function postAuth(Request $request)
    {
        $request->validate([
            'mobile' => ['bail', 'required', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric'],
        ], [
            'mobile.regex' => 'شماره موبایل وارد شده معتبر نیست',
            'mobile.digits' => 'شماره موبایل وارد شده معتبر نیست',
            'mobile.numeric' => 'شماره موبایل وارد شده معتبر نیست',
        ]);

        User::whereName(0)->wherePassword(0)->whereIsActivated(0)->delete();

        $user = User::wherePhone($request->mobile)->whereIsActivated(1)->get();

        if ($user->isEmpty()) {

            session(['new_user_mobile' => $request->mobile]);

            $new_user = User::create([
                'phone' => $request->mobile,

                'name' => 0,
                'is_activated' => 0,
                'password' => 0,
            ]);

            $code = rand(100000, 999999);

            Token::make($new_user, $code, 'register', 3);

            // Sms::sendCode($new_user->phone, $code);

            Log::info($code);

            return to_route ('user.getConfirm');
        }

        session(['user_mobile' => $request->mobile]);

        return to_route('user.getLogin');
    }

    public function getConfirm()
    {
        if (session()->has('new_user_mobile_confirmed')) {
            return to_route('user.getRegister');
        }

        $new_user = User::wherePhone(session()->get('new_user_mobile'))->first();

        if ( ! session()->has('new_user_mobile') or ! Token::has($new_user, 'register')) {
            return to_route('user.getAuth');
        }

        return view('user.confirm');
    }

    public function postConfirm(Request $request)
    {
        if (session()->has('new_user_mobile_confirmed')) {
            return to_route('user.getRegister');
        }

        $new_user = User::wherePhone(session()->get('new_user_mobile'))->first();

        if ( ! session()->has('new_user_mobile') or ! Token::has($new_user, 'register')) {
            return to_route('user.getAuth');
        }


        $request->validate([
            'code' => ['required', 'numeric', 'digits:6'],
        ], [
            'code.numeric' => 'کد تایید باید یک عدد 6 رقمی باشد',
            'code.digits' => 'کد تایید باید یک عدد 6 رقمی باشد',
        ]);

        $new_user = User::wherePhone(session()->get('new_user_mobile'))->firstOrFail();

        $token = Token::get($new_user, 'register');

        if (is_null($token)) {
            return to_route('user.getAuth');
        }

        if (Hash::check($request->code, $token->token)) {
            $token->delete();
            session(['new_user_mobile_confirmed' => true]);
            session(['new_user_register_time' => now()->addMinutes(15)]);
            return to_route('user.getRegister');
        }

        return back()->withErrors(['invalidCode' => 'کد وارد شده نامعتبر است']);
    }

    public function getRegister()
    {
        $new_user = User::wherePhone(session()->get('new_user_mobile'))->first();

        if (session()->has('new_user_mobile') and Token::has($new_user, 'register')) {
            return to_route ('user.getConfirm');
        }

        if ( ! session()->has('new_user_mobile') or ! session()->has('new_user_mobile_confirmed') or ! session()->has('new_user_register_time') or session()->get('new_user_register_time') < now()) {
            return to_route('user.getAuth');
        }

        return view('user.register');
    }

    public function postRegister(Request $request)
    {
        $new_user = User::wherePhone(session()->get('new_user_mobile'))->first();

        if (session()->has('new_user_mobile') and Token::has($new_user, 'register')) {
            return to_route ('user.getConfirm');
        }

        if ( ! session()->has('new_user_mobile') or ! session()->has('new_user_mobile_confirmed') or ! session()->has('new_user_register_time') or session()->get('new_user_register_time') < now()) {
            return to_route('user.getAuth');
        }


        $request->validate([
            'name' => ['bail', 'required', 'string', 'max:40'],
            'state' => ['required', 'exists:states,id'],
            'password' => ['bail', 'required', Password::min(8)->letters()->numbers(), 'confirmed'],
        ]);

        $user = User::wherePhone(session()->get('new_user_mobile'))->firstOrFail();

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'is_activated' => 1,
        ]);

        $request->session()->regenerate();

        Auth::guard('admin')->logout();
        Auth::guard('manager')->logout();
        Auth::guard('member')->logout();

        Auth::guard('web')->loginUsingId($user->id);


        $url = session('url.intended') ?? route('user.profile');
        $request->session()->forget('url.intended');

        return redirect($url);
    }

    public function getLogin()
    {
        if ( ! session()->has('user_mobile')) {
            return to_route('user.getAuth');
        }

        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        if ( ! session()->has('user_mobile')) {
            return to_route('user.getAuth');
        }


        $request->validate([
            'password' => ['required'],
        ]);

        $user = User::wherePhone(session()->get('user_mobile'))->firstOrFail();

        if (Hash::check($request->password, $user->password)) {

            $request->session()->regenerate();

            Auth::guard('admin')->logout();
            Auth::guard('manager')->logout();
            Auth::guard('member')->logout();
    
            Auth::guard('web')->loginUsingId($user->id);
    
            $url = session('url.intended') ?? route('user.profile');
            $request->session()->forget('url.intended');

            return redirect($url);
        }

        return back()->withErrors(['password' => 'رمز عبور اشتباه است']);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}