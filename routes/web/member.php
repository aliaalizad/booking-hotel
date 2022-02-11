<?php

use App\Http\Controllers\Member\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest:member'])->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:member', 'access_check'])->group(function(){
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});
