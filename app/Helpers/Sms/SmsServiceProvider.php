<?php

namespace App\Helpers\Sms;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('sms', function(){
            return new SmsService();
        });
    }

}