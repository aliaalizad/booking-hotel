<?php

namespace App\Helpers\Booking;

use Illuminate\Support\ServiceProvider;

class BookingServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('booking', function(){
            return new BookingService();
        });
    }

}