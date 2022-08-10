<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\BaseController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest:web'])->controller(AuthController::class)->group(function(){
    Route::get('/auth', 'getAuth')->name('getAuth');
    Route::post('/auth', 'postAuth')->name('postAuth');
    Route::get('/auth/confirm', 'getConfirm')->name('getConfirm');
    Route::post('/auth/confirm', 'postConfirm')->name('postConfirm');
    Route::get('/auth/register', 'getRegister')->name('getRegister');
    Route::post('/auth/register', 'postRegister')->name('postRegister');
    Route::get('/auth/login', 'getLogin')->name('getLogin');
    Route::post('/auth/login', 'postLogin')->name('postLogin');
});

Route::post('/profile/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:web', 'access_check'])->prefix('/profile')->group(function(){
    Route::get('/', [AuthController::class, 'profile'])->name('profile');
    Route::get('/booking/{booking}', [BaseController::class, 'showBooking'])->name('showBooking');
});
