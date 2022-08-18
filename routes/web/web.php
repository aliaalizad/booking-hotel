<?php

use App\Helpers\Token\Token;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


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


Route::get('test', function() {

    // LogEvent::create([
    //     'name' => 'booking',
    //     'description' => 'رزرو',
    //     'parameters' => [
    //         'room',
    //     ],
    // ]);

    // $payment = Payment::where('track_id', 2962757848)->firstOrFail();

    // dd($payment->booking->room->numbers);

    // Logs::putBooking(2, [
    //     'room' => [
    //         'numbers' => $payment->booking->room->numbers,
    //         'price' => $payment->booking->room->price,
    //     ]
    // ]);

    // $log = Logs::getBooking(2);

    // dd($log->last());

    // session(['last_confirmable_url', url()->current()]);

    dd(Token::isValid(user(), '92047', 'confirm'));

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


Route::prefix('/panel')->name('panel.')->middleware(['guest:manager', 'guest:member'])->group(function(){
        Route::get('/', [AuthController::class, 'getAuth'])->name('getAuth');
        Route::post('/', [AuthController::class, 'postAuth'])->name('postAuth');
});