<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\UserController;
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
})->name('index');

// Socialite Login
Route::get('login/discord', [LoginController::class, 'redirectToProvider'])
    ->name('login.discord');
Route::get('login/discord/callback', [LoginController::class, 'handleProviderCallback']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// User Routes
Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

});
