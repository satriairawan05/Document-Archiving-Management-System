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
    // Login
    Route::get('login',[AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login',[AuthController::class, 'login'])->name('login.form');

    // Register
    Route::get('register',[AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register',[AuthController::class, 'register'])->name('register.form');
});

Route::middleware(['auth'])->group(function(){
    // Home
    Route::get('home', HomeController::class)->name('home');

    // Role Permission
    Route::resource('group', \App\Http\Controllers\Admin\Setting\GroupController::class)->except(['show']);

    // Profile
    Route::resource('profile',\App\Http\Controllers\Admin\Setting\ProfileController::class)->only(['index','edit','update']);

    // Letter Type
    Route::resource('letter_type', \App\Http\Controllers\Admin\LetterTypeController::class)->except(['show']);

    // Incoming Mail
    Route::resource('incoming_mail', \App\Http\Controllers\Admin\IncomingMailController::class);

    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

