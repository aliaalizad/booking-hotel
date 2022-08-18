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

                $is_blocked = Manager::find(user()->id)->is_blocked;

                if ($is_blocked) {
                    Auth::guard('manager')->logout();

                    return to_route('panel.getAuth')->withErrors([
                        'login' => 'حساب کاربری شما مسدود شده است',
                    ]);
                }


            } elseif ($request->routeIs('member.*')) { // member

                $is_blocked = Member::find(user()->id)->is_blocked;

                if ($is_blocked) {
                    Auth::guard('member')->logout();

                    return to_route('panel.getAuth')->withErrors([
                        'login' => 'حساب کاربری شما مسدود شده است',
                    ]);
                }



            } else { // user

                $is_blocked = User::find(user()->id)->is_blocked;

                if ($is_blocked) {
                    Auth::guard('web')->logout();
    
                    return to_route('user.getAuth')->withErrors([
                        'login' => 'حساب کاربری شما مسدود شده است',
                    ]);
                }
            }
        }

        return $next($request);
    }
}
