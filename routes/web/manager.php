<?php

use App\Http\Controllers\Auth\ManagerAuthController;
use App\Http\Controllers\Hotel\ManagerResourceController as HotelManagerResourceController;
use App\Http\Controllers\Member\ManagerResourceController as MemberManagerResourceController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest:manager'])->group(function(){
    Route::get('/login', [ManagerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ManagerAuthController::class, 'login'])->name('login');
});
Route::post('/logout', [ManagerAuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:manager', 'access_check'])->group(function(){
    Route::get('/', [ManagerAuthController::class, 'index'])->name('dashboard');
    Route::resource('/members', MemberManagerResourceController::class)->except('show');
    Route::resource('/hotels', HotelManagerResourceController::class)->except('show');
});