<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\BaseController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest:web'])->controller(AuthController::class)->group(function(){

    Route::prefix('/auth')->group(function(){
        Route::get('/', 'getAuth')->name('getAuth');
        Route::post('/', 'postAuth')->name('postAuth');
        Route::get('/confirm', 'getConfirm')->name('getConfirm');
        Route::post('/confirm', 'postConfirm')->name('postConfirm');
        Route::get('/register', 'getRegister')->name('getRegister');
        Route::post('/register', 'postRegister')->name('postRegister');
        Route::get('/login', 'getLogin')->name('getLogin');
        Route::post('/login', 'postLogin')->name('postLogin');
        Route::get('/forgot-password', 'getForgotPassword')->name('getForgotPassword');
        Route::post('/forgot-password', 'postForgotPassword')->name('postForgotPassword');
        Route::get('/forgot-password/confirm', 'getResetPasswordConfirm')->name('getResetPasswordConfirm');
        Route::post('/forgot-password/confirm', 'postResetPasswordConfirm')->name('postResetPasswordConfirm');
        Route::get('/reset-password', 'getResetPassword')->name('getResetPassword');
        Route::post('/reset-password', 'postResetPassword')->name('postResetPassword');
    });
});

Route::post('/profile/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:web', 'access_check'])->prefix('/profile')->group(function(){
    Route::get('/', [AuthController::class, 'profile'])->name('profile');
    Route::get('/booking/{booking}', [BaseController::class, 'showBooking'])->name('showBooking');
});
