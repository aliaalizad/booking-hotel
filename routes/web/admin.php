<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:admin'])->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function(){
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('/managers', ManagerController::class);
    Route::resource('/members', MemberController::class);
    Route::resource('/hotels', HotelController::class);
    Route::resource('/hotels/{hotel}/rooms', RoomController::class);

    Route::prefix('/hotels')->name('hotels.')->group(function(){
        Route::get('/{hotel}/bookings', [HotelController::class, 'indexBookings'])->name('bookings.index');
        Route::get('/{hotel}/bookings/{booking}', [HotelController::class, 'showBookings'])->name('bookings.show');
    });
    Route::resource('/permissions', PermissionController::class);
});