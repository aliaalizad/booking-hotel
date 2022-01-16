<?php

namespace App\Http\Middleware;

use App\Models\Manager;
use App\Models\Member;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        
        
        if (! $request->expectsJson()) {

            if ($request->routeIs('manager.*')) { // manager

                $is_blocked = Manager::find(Auth::guard('manager')->user()->id)->is_blocked;

                if ($is_blocked) {
                    Auth::guard('manager')->logout();

                    return redirect()->route('manager.login')->withErrors([
                        'loginError' => 'حساب کاربری شما مسدود شده است',
                    ]);
                }



            } elseif ($request->routeIs('member.*')) { // member

                $is_blocked = Member::find(Auth::guard('member')->user()->id)->is_blocked;

                if ($is_blocked) {
                    Auth::guard('member')->logout();

                    return redirect()->route('member.login')->withErrors([
                        'loginError' => 'حساب کاربری شما مسدود شده است',
                    ]);
                }



            } else { // user

                $is_blocked = User::find(Auth::guard('web')->user()->id)->is_blocked;

                if ($is_blocked) {
                    Auth::guard('web')->logout();
    
                    return redirect()->route('user.login')->withErrors([
                        'loginError' => 'حساب کاربری شما مسدود شده است',
                    ]);
                }
            }
        }

        return $next($request);
    }
}
