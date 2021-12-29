<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberLoginRequest;
use Illuminate\Http\Request;

class MemberLoginController extends Controller
{
    public function show()
    {
        return view('member.login');
    }

    public function create(MemberLoginRequest $request)
    {
        return redirect()->route('member.dashboard');
    }}
