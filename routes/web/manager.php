<?php

use App\Http\Controllers\Manager\AuthController;
use App\Http\Controllers\Manager\BookingController;
use App\Http\Controllers\Manager\HotelController;
use App\Http\Controllers\Manager\MemberController;
use App\Http\Controllers\Manager\RoomController;
use App\Http\Controllers\Manager\UnbookableController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest:manager'])->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:manager', 'access_check'])->group(function(){
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('/members', MemberController::class)->except('show');
    Route::resource('/hotels', HotelController::class)->except('show');
    Route::resource('/hotels/{hotel}/rooms', RoomController::class);

    Route::prefix('/hotels')->name('hotels.')->group(function(){
        Route::get('/{hotel}/bookings', [HotelController::class, 'indexBookings'])->name('bookings.index');
        Route::get('/{hotel}/bookings/{booking}', [HotelController::class, 'showBookings'])->name('bookings.show');

        Route::prefix('/{hotel}/unbookables')->name('unbookables.')->group(function(){
            Route::get('/', [UnbookableController::class, 'index'])->name('index');
            Route::post('/create', [UnbookableController::class, 'store'])->name('store');
            Route::delete('/{unbookable}', [UnbookableController::class, 'delete'])->name('delete');
        });
    });

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
});

