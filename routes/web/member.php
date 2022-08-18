<?php

use App\Http\Controllers\Member\AuthController;
use App\Http\Controllers\Member\BookingController;
use App\Http\Controllers\Member\ReportController;
use App\Http\Controllers\Member\RoomController;
use App\Http\Controllers\Member\UnbookableController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:member', 'access_check'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [AuthController::class, 'index']);
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');

    Route::get('/hotel/bookings/calendar', [BookingController::class, 'calendar'])->name('bookings.calendar');
    Route::get('/hotel/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');

    Route::prefix('/hotel')->name('hotel.')->group(function(){
        Route::resource('/rooms', RoomController::class);

        Route::prefix('/unbookables')->name('unbookables.')->group(function(){
            Route::get('/', [UnbookableController::class, 'index'])->name('index');
            Route::post('/create', [UnbookableController::class, 'store'])->name('store');
            Route::delete('/{unbookable}', [UnbookableController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('/reports')->name('reports.')->group(function(){
        Route::prefix('/income')->name('income.')->group(function(){
            Route::get('/analysis', [ReportController::class, 'incomeAnalysis'])->name('analysis');
            Route::get('/daily/list', [ReportController::class, 'dailyIncomeList'])->name('dailyList');
            Route::get('/monthly/list', [ReportController::class, 'monthlyIncomeList'])->name('monthlyList');
        });
    });
});
