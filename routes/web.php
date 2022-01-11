<?php

use App\Classes\Token\UserToken;
use App\Http\Controllers\Manager\ManagerAuthController;
use App\Http\Controllers\Member\MemberAuthController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\Admin\ManagerModifyController;
use App\Http\Controllers\Admin\MemberModifyController;
use App\Models\Token;
use App\Models\User;
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
    // UserToken::make(5,1,'register', 5);
    dd(request()->session()->all());

}); 

// Admin
Route::prefix('/admin')->name('admin.')->group(function(){

    Route::get('/', function(){ return redirect()->route('admin.dashboard') ;});
    Route::get('/dashboard', function(){ return view('admin.dashboard') ;})->name('dashboard');

    Route::resource('/manager', ManagerModifyController::class)->except(['show']);
    Route::resource('/member', MemberModifyController::class)->except(['show']);
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

    Route::middleware(['auth:web'])->get('/profile', [UserAuthController::class, 'index'])->name('profile');
});

// Manager
Route::prefix('/manager')->name('manager.')->group(function(){

    Route::get('/', function(){ return redirect()->route('manager.dashboard'); });

    Route::middleware(['guest:manager'])->group(function(){
        Route::get('/login', [ManagerAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [ManagerAuthController::class, 'login'])->name('login');
    });
    Route::get('/logout', function(){ abort(404); });
    Route::post('/logout', [ManagerAuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:manager'])->get('/dashboard', [ManagerAuthController::class, 'index'])->name('dashboard');


});

// member
Route::prefix('/member')->name('member.')->group(function(){

    Route::get('/', function(){ return redirect()->route('member.dashboard'); });

    Route::middleware(['guest:member'])->group(function(){
        Route::get('/login', [MemberAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [MemberAuthController::class, 'login'])->name('login');
    });
    Route::get('/logout', function(){ abort(404); });
    Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:member'])->get('/dashboard', [MemberAuthController::class, 'index'])->name('dashboard');

});
