<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$panels
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$panels)
    {
        $panels = empty($panels) ? [null] : $panels;

        foreach ($panels as $panel) {
            if (Auth::guard($panel)->check()) {

                if ($panel === 'admin') {
                    return to_route('admin.dashboard');
                }

                if ($panel === 'manager') {
                    return to_route('manager.dashboard');
                }

                if ($panel === 'member') {
                    return to_route('member.dashboard');
                }

                return to_route('user.profile');
                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
