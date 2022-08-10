<?php

namespace App\Http\Controllers;

use App\Helpers\Sms\Sms;
use App\Helpers\Token\AdminToken;
use App\Helpers\Token\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ConfirmController extends Controller
{
    public function confirm(Request $request)
    {
        $request->validate([
            'code' => ['required', 'numeric', 'digits:6']
        ]);

        if (Token::isValid(user(), $request->code, 'confirm')) {
            session(['confirmed' => true]);
            Token::get(user(), 'confirm')->delete();

            return redirect(session()->get('last_confirmable_url'));
        }

        return back()->withErrors(['InvalidCode' => 'کد وارد شده نامعتبر است']);
    }

    public function showConfirm()
    {
        $code = rand(100000, 999999);

        if (! Token::has(user(), 'confirm')) {
            Token::make(user(), $code, 'confirm', 5);
            // Sms::sendCode(user()->phone, $code);
            Log::info($code);
        }

        return view('confirm');
    }
}
