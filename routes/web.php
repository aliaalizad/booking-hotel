<?php

use App\Classes\Token\UserToken;
use App\Http\Controllers\Manager\ManagerAuthController;
use App\Http\Controllers\Member\MemberAuthController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\Admin\ManagerModifyController;
use App\Http\Controllers\Admin\MemberModifyController as Admin_MemberModifyController;
use App\Http\Controllers\Manager\MemberModifyController as Manager_MemberModifyController;
use App\Models\Manager;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider withi   n a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){




})->name('home'); 

// Admin
Route::prefix('/admin')->name('admin.')->group(function(){

    Route::get('/', function(){ return redirect()->route('admin.dashboard') ;});
    Route::get('/dashboard', function(){ return view('admin.dashboard') ;})->name('dashboard');

    Route::resource('/managers', ManagerModifyController::class);
    Route::resource('/members', Admin_MemberModifyController::class);
});

// User
Route::name('user.')->group(function(){
    Route::middleware(['guest:web'])->group(function(){
        Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [UserAuthController::class, 'register']);
        Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [UserAuthController::class, 'login']);

        Route::get('/register/confirm', [UserAuthController::class, 'showConfirmForm'])->name('confirm');
        Route::post('/register/confirm', [UserAuthController::class, 'confirm']);
    });

    Route::get('/profile/logout', function(){ abort(404); });
    Route::post('/profile/logout', [UserAuthController::class, 'logout'])->name('logout');

    
    Route::middleware(['auth:web', 'access_check'])->prefix('/profile')->group(function(){
        Route::get('/', [UserAuthController::class, 'index'])->name('profile');

    });

});

// Manager
Route::prefix('/manager')->name('manager.')->group(function(){

    Route::middleware(['guest:manager'])->group(function(){
        Route::get('/login', [ManagerAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [ManagerAuthController::class, 'login'])->name('login');
    });
    Route::get('/logout', function(){ abort(404); });
    Route::post('/logout', [ManagerAuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:manager', 'access_check'])->group(function(){
        Route::get('/', [ManagerAuthController::class, 'index'])->name('dashboard');

        Route::resource('/members', Manager_MemberModifyController::class);
    });
});

// member
Route::prefix('/member')->name('member.')->group(function(){

    Route::middleware(['guest:member'])->group(function(){
        Route::get('/login', [MemberAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [MemberAuthController::class, 'login'])->name('login');
    });
    Route::get('/logout', function(){ abort(404); });
    Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:member', 'access_check'])->group(function(){
        Route::get('/', [MemberAuthController::class, 'index'])->name('dashboard');
    });
});
