<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DashboardServerController;
use App\Http\Controllers\User\ProfileController;
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
            // Specific Server Routes
            Route::prefix('{slug}')->group(function () {
                Route::get('/', [DashboardServerController::class, 'show'])->name('show');
                Route::get('animalkills', [DashboardServerController::class, 'animalkills'])->name('animalkills');
                Route::get('destroyedcontainers', [DashboardServerController::class, 'destroyedcontainers'])->name('destroyedcontainers');
                Route::get('destroyedstructures', [DashboardServerController::class, 'destroyedstructures'])->name('destroyedstructures');
                Route::get('placeddeployables', [DashboardServerController::class, 'placeddeployables'])->name('placeddeployables');
                Route::get('placedstructures', [DashboardServerController::class, 'placedstructures'])->name('placedstructures');
                Route::get('playerconnections', [DashboardServerController::class, 'playerconnections'])->name('playerconnections');
                Route::get('playercrafting', [DashboardServerController::class, 'playercrafting'])->name('playercrafting');
                Route::get('playerdeaths', [DashboardServerController::class, 'playerdeaths'])->name('playerdeaths');
                Route::get('playerkills', [DashboardServerController::class, 'playerkills'])->name('playerkills');
                Route::get('weaponfire', [DashboardServerController::class, 'weaponfire'])->name('weaponfire');
                Route::get('playergathering', [DashboardServerController::class, 'playergathering'])->name('playergathering');
            }); // End Specific Server
        }); // End server

    }); // End Dashboard

    // User Profile
    Route::prefix('profile')->name('profile.')->group(function () {
       Route::get('/', [ProfileController::class, 'index'])->name('index');
       Route::get('settings', [ProfileController::class, 'settings'])->name('settings');
       Route::get('apikeys', [ProfileController::class, 'apikeys'])->name('apikeys');
    });
});
