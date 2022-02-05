<?php

use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest:web'])->group(function(){
    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login']);

    Route::get('/register/confirm', [UserAuthController::class, 'showConfirmForm'])->name('confirm');
    Route::post('/register/confirm', [UserAuthController::class, 'confirm']);
});

Route::post('/profile/logout', [UserAuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:web', 'access_check'])->prefix('/profile')->group(function(){
    Route::get('/', [UserAuthController::class, 'index'])->name('profile');
});