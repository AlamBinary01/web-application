<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mobile-verificaiton',[  HomeController::class,'sendOTP' ]); 
Route::post('/store-user-data', [UserController::class, 'storeUserData']);
Route::get('/user/{phone_number}', [UserController::class, 'showUserData']);


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/users', [UserController::class, 'showAllUsers'])->name('admin.users');
    
    // Protect the admin routes with middleware
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
});