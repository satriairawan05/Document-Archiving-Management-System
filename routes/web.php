<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function(){
    Route::get('login',[AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',[AuthController::class, 'login'])->name('login.form');
    Route::get('register',[AuthController::class, 'showRegisterForm'])->name('register');
    Route::Post('register',[AuthController::class, 'register'])->name('register.form');
});

Route::middleware(['auth'])->group(function(){
    Route::get('home', HomeController::class)->name('home');

    Route::resource('group', \App\Http\Controllers\Admin\Setting\GroupController::class);
    Route::resource('profile',\App\Http\Controllers\Admin\Setting\ProfileController::class)->only(['index','edit','update']);

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

