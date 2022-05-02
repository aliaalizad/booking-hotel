<?php

use App\Helpers\Logs\Logs;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Models\Manager;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/add-rooms', function(){

    $capacity = 3;
    $price = 1500000;
    $type = 'A';
    $hotel_id = 1;

    foreach (range(1,3) as $item) {
        Room::create([
            'code' => Str::random(40),
            'name' => ' اتاق ' . $capacity . ' تخته ',
            'type' => $type,
            'capacity' => $capacity,
            'price' => $price,
            'hotel_id' => $hotel_id,
        ]);
    }

    $capacity = 4;
    $price = 2000000;
    $type = 'B';
    $hotel_id = 1;

    foreach (range(1,2) as $item) {
        Room::create([
            'code' => Str::random(40),
            'name' => ' اتاق ' . $capacity . ' تخته ',
            'type' => $type,
            'capacity' => $capacity,
            'price' => $price,
            'hotel_id' => $hotel_id,
        ]);
    }

    $capacity = 2;
    $price = 1000000;
    $type = 'C';
    $hotel_id = 1;

    foreach (range(1,1) as $item) {
        Room::create([
            'code' => Str::random(40),
            'name' => ' اتاق ' . $capacity . ' تخته ',
            'type' => $type,
            'capacity' => $capacity,
            'price' => $price,
            'hotel_id' => $hotel_id,
        ]);
    }
});



Route::get('test', function() {

    // Logs::put(auth('web')->user(), 'login', [request()->ip(), 5, true]);
    // $logs = Logs::get(auth('web')->user(), 1);

    
})->name('test');





Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [BookingController::class, 'searchResults'])->name('search');

Route::get('/hotel', [BookingController::class, 'singleHotel'])->name('hotel');


Route::prefix('reserve')->name('reserve.')->middleware(['auth:web', 'access_check'])->group(function(){

    Route::get('/passengers', [BookingController::class, 'showPassengersForm'])->name('passengers');

    Route::post('/proccess', [BookingController::class, 'proccess'])->name('proccess');

    Route::get('/confirm', [BookingController::class, 'showConfirmForm'])->name('confirm');

    Route::post('/payment', [BookingController::class, 'payment'])->name('payment');

    Route::get('payment/callback', [BookingController::class, 'paymentCallback'])->name('payment.callback');

    Route::post('/ajaxCheck', [BookingController::class, 'lastConfirmation'])->name('lastConfirmation');
});


Route::get('error/not-bookable', function(){
    return view('errors.not-bookable');
})->name('errors.not-bookable');
