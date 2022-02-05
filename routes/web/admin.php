<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Manager\AdminResourceController as ManagerAdminResourceController;
use App\Http\Controllers\Member\AdminResourceController as MemberAdminResourceController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest:admin'])->group(function(){
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
});


Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');


Route::middleware(['auth:admin'])->group(function(){
    Route::get('/', function(){ return redirect()->route('admin.dashboard') ;});
    Route::get('/dashboard', function(){ return view('admin.dashboard') ;})->name('dashboard');
    Route::resource('/managers', ManagerAdminResourceController::class)->except('show');
    Route::resource('/members', MemberAdminResourceController::class)->except('show');
    Route::resource('/contracts', ContractModifyController::class)->except('show');
});
