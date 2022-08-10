<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

function permission($abilities, $arguments = []) {

    if (guard('admin')) {
        $user = Auth::guard('admin')->user();
        $guard = 'admin';

    } elseif (guard('manager')) {
        $user = Auth::guard('manager')->user();
        $guard = 'manager';

    } elseif (guard('member')) {
        $user = Auth::guard('member')->user();
        $guard = 'member';

    } elseif (guard('web')) {
        $user = Auth::guard('web')->user();
        $guard = 'web';
    } else {
        return false;
    }


    if (  is_array($abilities) ) {
        foreach ($abilities as $ability) {
            if ( Gate::forUser($user)->allows($ability, $guard) ) {
                return true;
            }
        }
        return false;
    }


    if ( ! is_array($abilities) ) {
        return Gate::forUser($user)->allows($abilities, $guard) ? true : false ;
    }
}

function guard($guards) {
    if (is_array($guards)) {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return true;
            }
        }
        return false;
    }

    return Auth::guard($guards)->check() ? true : false ;
}

function get_prefix() {

    if (Auth::guard('admin')->check()) {
        return 'admin';
    } elseif (Auth::guard('manager')->check()) {
        return 'manager';
    } elseif (Auth::guard('member')->check()) {
        return 'member';
    } elseif (Auth::guard('web')->check()) {
        return 'user';
    }
}

function user($guard = null) {

    if (isset($guard)) {
        if(guard($guard)){
            $user = $user = Auth::guard($guard)->user();
        }
        $user = null;
    }

    if (guard('admin')) {
        $user = Auth::guard('admin')->user();

    } elseif (guard('manager')) {
        $user = Auth::guard('manager')->user();

    } elseif (guard('member')) {
        $user = Auth::guard('member')->user();

    } elseif (guard('web')) {
        $user = Auth::guard('web')->user();
    } else {
        $user = null;
    }

    return $user;
}

