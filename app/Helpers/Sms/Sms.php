<?php

namespace App\Helpers\Sms;

use Illuminate\Support\Facades\Log;

class Sms {

    public static function send($content, $to)
    {
        $message = 'Code is ' . $content . " [$to]";
        Log::info($message);
    }

}
