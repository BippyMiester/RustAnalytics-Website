<?php

use App\Http\Controllers\Api\V1\AnimalKillsController;
use App\Http\Controllers\Api\V1\PlayerBansController;
use App\Http\Controllers\Api\V1\PlayerCraftingController;
use App\Http\Controllers\Api\V1\DestroyedBuildingsController;
use App\Http\Controllers\Api\V1\DestroyedContainersController;
use App\Http\Controllers\Api\V1\PlayerKillsController;
use App\Http\Controllers\Api\V1\PlacedDeployablesController;
use App\Http\Controllers\Api\V1\PlacedStructuresController;
use App\Http\Controllers\Api\V1\PlayerConnectionsController;
use App\Http\Controllers\Api\V1\PlayerDataController;
use App\Http\Controllers\Api\V1\PlayerDeathsController;
use App\Http\Controllers\Api\V1\PlayerGatherController;
use App\Http\Controllers\Api\V1\PlayerTimeController;
use App\Http\Controllers\Api\V1\ServerDataController;
use App\Http\Controllers\Api\V1\WeaponFireController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Server
    Route::prefix('server')->group(function () {
        // Server Data
        Route::prefix('data')->group(function () {
           Route::post('create', [ServerDataController::class, 'create']);
        });

        // Animal Kill Data
        Route::prefix('animalkills')->group(function () {
            Route::post('create', [AnimalKillsController::class, 'create']);
        });

        // Crafting
        Route::prefix('crafting')->group(function () {
            Route::post('create', [PlayerCraftingController::class, 'create']);
        });

        // Destroyed Buildings
        Route::prefix('destroyedbuildings')->group(function () {
            Route::post('create', [DestroyedBuildingsController::class, 'create']);
        });

        // Destroyed Containers
        Route::prefix('destroyedcontainers')->group(function () {
            Route::post('create', [DestroyedContainersController::class, 'create']);
        });

        // Kills
        Route::prefix('kills')->group(function () {
            Route::post('create', [PlayerKillsController::class, 'create']);
        });

        // Placed Deployables
        Route::prefix('placeddeployables')->group(function () {
            Route::post('create', [PlacedDeployablesController::class, 'create']);
        });

        // Placed Structures
        Route::prefix('placedstructures')->group(function () {
            Route::post('create', [PlacedStructuresController::class, 'create']);
        });

        // Player Data
        Route::prefix('players')->group(function () {
            Route::prefix('bans')->group(function () {
               Route::post('create', [PlayerBansController::class, 'create']);
               Route::post('destroy', [PlayerBansController::class, 'destroy']);
            });
            Route::prefix('data')->group(function () {
                Route::post('create', [PlayerDataController::class, 'create']);
            });
            Route::prefix('connection')->group(function () {
                Route::post('create', [PlayerConnectionsController::class, 'create']);
            });
            Route::prefix('time')->group(function () {
                Route::post('create', [PlayerTimeController::class, 'create']);
            });
        });

        // Deaths
        Route::prefix('deaths')->group(function () {
            Route::post('create', [PlayerDeathsController::class, 'create']);
        });

        // Gathering
        Route::prefix('gathering')->group(function () {
            Route::post('create', [PlayerGatherController::class, 'create']);
        });

        // Weapon Fire
        Route::prefix('weaponfire')->group(function () {
            Route::post('create', [WeaponFireController::class, 'create']);
        });
    });
});
