<?php

namespace App\Helpers\Token;

use Illuminate\Support\ServiceProvider;

class TokenServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('token', function(){
            return new TokenService();
        });
    }

}