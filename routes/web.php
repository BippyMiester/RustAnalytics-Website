<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DashboardServerController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/test', [IndexController::class, 'test'])->name('test');

// Socialite Login
Route::get('login/discord', [LoginController::class, 'redirectToProvider'])
    ->name('login.discord');
Route::get('login/discord/callback', [LoginController::class, 'handleProviderCallback']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// User Routes
Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        // Dashboard Homepage
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        // Server Routes
        Route::prefix('server')->name('server.')->group(function () {
            Route::prefix('{slug}')->group(function () {
                Route::get('/', [DashboardServerController::class, 'show'])->name('show');
                Route::get('animalkills', [DashboardServerController::class, 'animalkills'])->name('animalkills');
            });

        });
    });
});
