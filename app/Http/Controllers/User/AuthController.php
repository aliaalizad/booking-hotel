<?php

namespace App\Http\Controllers\User;

use App\Helpers\Sms\Sms;
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
        $user = user();
        $bookings = user()->bookings()->where('status', 'paid')->orderBy('created_at', 'desc')->paginate();

        return view('user.dashboard', compact('user', 'bookings'));
    }

    public function getAuth()
    {
        request()->session()->forget('user_mobile');
        request()->session()->forget('user_login_time');
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
        session(['user_login_time' => now()->addMinutes(10)]);

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

        $token = Token::get($new_user, 'register');

        if (is_null($token)) {
            return to_route('user.getAuth');
        }

        if (Hash::check($request->code, $token->token)) {
            $token->delete();
            session(['new_user_mobile_confirmed' => true]);
            session(['new_user_register_time' => now()->addMinutes(10)]);
            return to_route('user.getRegister');
        }

        return back()->withErrors(['code' => 'کد وارد شده نامعتبر است']);
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
            'national_code' => ['bail', 'required', 'numeric', 'digits:10', 'unique:users,national_code'],
            'state' => ['required', 'exists:states,id'],
            'password' => ['bail', 'required', Password::min(8)->letters()->numbers(), 'confirmed'],
        ]);

        if (! is_valid_national_code($request->national_code)) {
            return back()->withErrors(['national_code' => 'کد ملی وارد شده نامعتبر است']);
        }

        $user = User::wherePhone(session()->get('new_user_mobile'))->firstOrFail();

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'state_id' => $request->state,
            'national_code' => $request->national_code,
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
        if ( ! session()->has('user_mobile') or session()->get('user_login_time') < now()) {
            return to_route('user.getAuth');
        }

        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        if ( ! session()->has('user_mobile') or session()->get('user_login_time') < now()) {
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

    public function getForgotPassword()
    {
        request()->session()->forget('user_forgot_password');
        request()->session()->forget('forgotten_user_mobile');
        request()->session()->forget('forgotten_user_mobile_confirmed');
        request()->session()->forget('reset-password_time');

        return view('user.forgot-password');
    }

    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'mobile' => ['bail', 'required', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric'],
        ], [
            'mobile.regex' => 'شماره موبایل وارد شده معتبر نیست',
            'mobile.digits' => 'شماره موبایل وارد شده معتبر نیست',
            'mobile.numeric' => 'شماره موبایل وارد شده معتبر نیست',
        ]);

        $user = User::wherePhone($request->mobile)->whereIsActivated(1)->first();


        if (is_null($user)) {
            return back()->withErrors(['mobile' => 'حساب کاربری با این شماره موبایل وجود ندارد'])->onlyInput('mobile');
        }

        session(['user_forgot_password' => true]);
        session(['forgotten_user_mobile' => $request->mobile]);

        $code = rand(100000, 999999);

        Token::make($user, $code, 'reset-password', 3);

        // Sms::sendCode($user->phone, $code);

        Log::info($code);

        return to_route('user.getResetPasswordConfirm');

    }

    public function getResetPasswordConfirm()
    {
        if (session()->has('forgotten_user_mobile_confirmed')) {
            return to_route('user.getResetPassword');
        }

        $forgotten_user = User::wherePhone(session()->get('forgotten_user_mobile'))->first();

        if ( ! session()->has('forgotten_user_mobile') or ! Token::has($forgotten_user, 'reset-password')) {
            return to_route('user.getForgotPassword');
        }

        return view('user.reset-password-confirm');
    }

    public function postResetPasswordConfirm(Request $request)
    {
        if (session()->has('forgotten_user_mobile_confirmed')) {
            return to_route('user.getResetPassword');
        }

        $forgotten_user = User::wherePhone(session()->get('forgotten_user_mobile'))->first();

        if ( ! session()->has('forgotten_user_mobile') or ! Token::has($forgotten_user, 'reset-password')) {
            return to_route('user.getForgotPassword');
        }


        $request->validate([
            'code' => ['required', 'numeric', 'digits:6'],
        ], [
            'code.numeric' => 'کد تایید باید یک عدد 6 رقمی باشد',
            'code.digits' => 'کد تایید باید یک عدد 6 رقمی باشد',
        ]);

        $token = Token::get($forgotten_user, 'reset-password');

        if (is_null($token)) {
            return to_route('user.getForgotPassword');
        }

        if (Hash::check($request->code, $token->token)) {
            $token->delete();
            session(['forgotten_user_mobile_confirmed' => true]);
            session(['reset_password_time' => now()->addMinutes(10)]);
            return to_route('user.getResetPassword');
        }

        return back()->withErrors(['invalidCode' => 'کد وارد شده نامعتبر است']);
    }

    public function getResetPassword()
    {
        if (! session()->has('user_forgot_password')) {
            return to_route('user.getForgotPassword');
        }

        $forgotten_user = User::wherePhone(session()->get('forgotten_user_mobile'))->first();

        if (session()->has('forgotten_user_mobile') and Token::has($forgotten_user, 'reset-password')) {
            return to_route ('user.getResetPasswordConfirm');
        }

        if ( ! session()->has('forgotten_user_mobile') or ! session()->has('forgotten_user_mobile_confirmed') or ! session()->has('reset_password_time') or session()->get('reset_password_time') < now()) {
            return to_route('user.getForgotPassword');
        }

        return view('user.reset-password');
    }

    public function postResetPassword(Request $request)
    {
        if (! session()->has('user_forgot_password') or ! session()->has('forgotten_user_mobile')) {
            return to_route('user.getForgotPassword');
        }

        $request->validate([
            'password' => ['bail', 'required', Password::min(8)->letters()->numbers(), 'confirmed'],
        ]);

        $user = User::wherePhone(session()->get('forgotten_user_mobile'))->firstOrFail();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return to_route('user.getAuth');

    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}