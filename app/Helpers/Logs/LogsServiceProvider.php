<?php

namespace App\Helpers\Logs;

use Illuminate\Support\ServiceProvider;

class LogsServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('logs', function(){
            return new LogsService();
        });
    }

}