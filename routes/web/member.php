<?php

use App\Http\Controllers\Member\AuthController;
use App\Http\Controllers\Member\BaseController;
use App\Http\Controllers\Member\BookingController;
use App\Http\Controllers\Member\RoomController;
use App\Http\Controllers\Member\UnbookableController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest:member'])->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:member', 'access_check'])->group(function(){
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings/calendar', [BookingController::class, 'calendar'])->name('bookings.calendar');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');

    Route::prefix('/hotel')->name('hotel.')->group(function(){
        Route::prefix('/unbookables')->name('unbookables.')->group(function(){
            Route::get('/', [UnbookableController::class, 'index'])->name('index');
            Route::post('/create', [UnbookableController::class, 'store'])->name('store');
            Route::delete('/{unbookable}', [UnbookableController::class, 'delete'])->name('delete');
        });
    });

});
