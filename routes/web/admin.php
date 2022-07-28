<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\UnbookableController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:admin'])->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function(){
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::resource('/permissions', PermissionController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/managers', ManagerController::class);
    Route::resource('/members', MemberController::class);
    Route::resource('/hotels', HotelController::class);
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
    Route::get('/reports', [ReportController::class, 'pdfReport'])->name('reports.pdf');

});