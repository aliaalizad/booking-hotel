<?php

use App\Http\Controllers\Manager\AuthController;
use App\Http\Controllers\Manager\BookingController;
use App\Http\Controllers\Manager\HotelController;
use App\Http\Controllers\Manager\MemberController;
use App\Http\Controllers\Manager\ReportController;
use App\Http\Controllers\Manager\RoomController;
use App\Http\Controllers\Manager\UnbookableController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth:manager', 'access_check'])->group(function(){

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [AuthController::class, 'index']);
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('/members', MemberController::class)->except('show');
    Route::resource('/hotels', HotelController::class)->except('show');
    
    Route::prefix('/hotels')->name('hotels.')->group(function(){
        Route::resource('/{hotel}/rooms', RoomController::class);
        Route::get('/{hotel}/bookings', [HotelController::class, 'indexBookings'])->name('bookings.index');
        Route::get('/{hotel}/bookings/{booking}', [HotelController::class, 'showBookings'])->name('bookings.show');

        Route::prefix('/{hotel}/unbookables')->name('unbookables.')->group(function(){
            Route::get('/', [UnbookableController::class, 'index'])->name('index');
            Route::post('/create', [UnbookableController::class, 'store'])->name('store');
            Route::delete('/{unbookable}', [UnbookableController::class, 'delete'])->name('delete');
        });
    });

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');

    Route::prefix('/reports')->name('reports.')->group(function(){
        Route::prefix('/income')->name('income.')->group(function(){
            Route::get('/analysis', [ReportController::class, 'incomeAnalysis'])->name('analysis');
            Route::get('/daily/list', [ReportController::class, 'dailyIncomeList'])->name('dailyList');
            Route::get('/monthly/list', [ReportController::class, 'monthlyIncomeList'])->name('monthlyList');
        });
    });
});

