<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest:web'])->controller(AuthController::class)->group(function(){
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');

    Route::get('/register/confirm', 'showConfirmForm')->name('confirm');
    Route::post('/register/confirm', 'confirm');
});

Route::post('/profile/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:web', 'access_check'])->prefix('/profile')->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('profile');
});
