<?php

use App\Http\Controllers\Manager\AuthController;
use App\Http\Controllers\Manager\HotelController;
use App\Http\Controllers\Manager\MemberController;
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
});