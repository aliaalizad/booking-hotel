<?php

use App\Http\Controllers\Auth\MemberAuthController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest:member'])->group(function(){
    Route::get('/login', [MemberAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [MemberAuthController::class, 'login'])->name('login');
});

Route::get('/logout', function(){ abort(404); });
Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:member', 'access_check'])->group(function(){
    Route::get('/', [MemberAuthController::class, 'index'])->name('dashboard');
});