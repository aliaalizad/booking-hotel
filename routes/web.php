<?php

use App\Http\Controllers\User\UserRegisterController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\Manager\ManagerLoginController;
use App\Http\Controllers\Member\MemberLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::prefix('/admin')->name('admin.')->group(function(){

});

// User
Route::name('user.')->group(function(){

    Route::get('/register', [UserRegisterController::class, 'show'])->name('register');
    Route::post('/register', [UserRegisterController::class, 'create'])->name('register');
    Route::get('/login', [UserLoginController::class, 'show'])->name('login');
    Route::post('/login', [UserLoginController::class, 'create'])->name('login');
    Route::get('/profile', function(){ return view('user.profile'); })->name('profile');
    
    Route::prefix('profile')->name('profile.')->group(function(){

    });

});


// Manager
Route::prefix('/manager')->name('manager.')->group(function(){
    Route::get('/', function(){ return redirect()->route('manager.dashboard'); })->name('login');

    Route::get('/login', [ManagerLoginController::class, 'show'])->name('login');
    Route::post('/login', [ManagerLoginController::class, 'create'])->name('login');
    Route::get('/dashboard', function(){ return view('manager.dashboard'); })->name('dashboard');
});

// Member
Route::prefix('/member')->name('member.')->group(function(){
    Route::get('/', function(){ return redirect()->route('member.dashboard'); })->name('login');

    Route::get('/login', [MemberLoginController::class, 'show'])->name('login');
    Route::post('/login', [MemberLoginController::class, 'create'])->name('login');
    Route::get('/dashboard', function(){ return view('member.dashboard'); })->name('dashboard');
});