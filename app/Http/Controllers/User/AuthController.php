<?php

namespace App\Http\Controllers\User;

use App\Helpers\Sms\Sms;
use App\Helpers\Token\UserToken;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function index()
    {
        $bookings = user()->bookings()->where('status', 'paid')->orderBy('created_at', 'desc')->paginate();

        return view('user.dashboard', compact('bookings'));
    }


    public function showRegisterForm()
    {
        return view('user.register');
    }


    public function register(Request $request)
    {
        // validate inputs
        $validator = Validator::make($request->all(),[
            'name'      => ['required'],
            'phone'     => ['required', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric'],
            'password'  => ['required'],
            'cpassword' => ['required', 'same:password'],
        ]);

        $validator->sometimes('phone', 'unique:users,phone', function($input) {
            return User::where([['phone', $input->phone],['is_activated', 1]])->first();
        })->validated();

        if (User::where('phone', $request->phone)->first()) {
            // update user information
            $user = User::where('phone', $request->phone)->first();
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->save();

        } else {

            User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'is_activated' => 0,
            ]);
        }

        // find the user
        $user = User::where('phone', $request->phone)->first();

        // checks that there is no token for this user
        if ( ! UserToken::exists($user->id, 'register') ) {
            // generate code
            $code = mt_rand(100000, 999999);

            //make token
            UserToken::make($user->id, $code, 'register', 5);

            // send sms 
            Sms::sendCode($request->phone, $code);
        }

        // create session
        $request->session()->put('id', $user->id);

        return to_route('user.confirm');
    }


    public function showLoginForm()
    {
        if (! session()->has('url.intended')) {
            session()->forget('url.intended');
            session()->put('url.intended', url()->previous());
        }

        return view('user.login');
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone'     => ['required'],
            'password'  => ['required'],
        ])->validated();

        if (Auth::guard('web')->attempt($validator)) {

            Auth::guard('admin')->logout();
            Auth::guard('manager')->logout();
            Auth::guard('member')->logout();

            if (Auth::guard('web')->user()->is_activated == 0) {

                if ( UserToken::exists(Auth::guard('web')->user()->id, 'register') ){

                    $request->session()->put('id', Auth::guard('web')->user()->id);

                    Auth::guard('web')->logout();

                    return to_route('user.confirm');
                }

                Auth::guard('web')->logout();
                return back()->withErrors([
                    'loginError' => 'شماره موبایل یا رمز عبور صحیح نیست',
                ]);
            }
            $request->session()->forget('id');
            $request->session()->regenerate();

            $url = session('url.intended') ?? route('user.profile');
            $request->session()->forget('url.intended');

            return redirect($url);
        }

        return back()->withErrors([
            'loginError' => 'شماره موبایل یا رمز عبور صحیح نیست',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }


    public function showConfirmForm(Request $request)
    {
        if ( ! $request->session()->has('id') || ! UserToken::exists($request->session()->get('id'), 'register') ) {
            return to_route('user.register');
        }
        
        return view('user.confirm');
    }


    public function confirm(Request $request)
    {
        // validate user inputs
        $credentials = $request->validate([
            'code' => ['required', 'digits:6']
        ]);

        // redirect
        if ( ! $request->session()->has('id') || ! UserToken::exists($request->session()->get('id'), 'register') ) {
            return to_route('panels.user.register');
        }


        $id = $request->session()->get('id');

        if (UserToken::exists($id, 'register')) {

            if (UserToken::isValid($id, $credentials['code'], 'register')) {
                // confirm registeration
                $user = User::find($id);
                $user->is_activated = 1;
                $user->save();
                
                // delete session
                $request->session()->forget('id');

                // delete token
                UserToken::delete($id, 'register');

                // logout other guards
                Auth::guard('admin')->logout();
                Auth::guard('manager')->logout();
                Auth::guard('member')->logout();
                //login user
                Auth::guard('web')->loginUsingId($id);
                
                // redirect
                $url = session('url.intended') ?? route('user.profile');
                $request->session()->forget('url.intended');
    
                return redirect($url);
            }

            return back()->withErrors([
                'invalidError' => 'کد وارد شده معتبر نیست',
            ]);
        }

        return to_route('panels.user.register');
    }

}