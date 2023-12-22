<?php

use App\Http\Controllers\Api\V1\ServerAnimalKillDataController;
use App\Http\Controllers\Api\V1\ServerCraftingDataController;
use App\Http\Controllers\Api\V1\ServerDestroyedBuildingsDataController;
use App\Http\Controllers\Api\V1\ServerDestroyedContainersDataController;
use App\Http\Controllers\Api\V1\ServerKillsDataController;
use App\Http\Controllers\Api\V1\ServerPlacedDeployablesDataController;
use App\Http\Controllers\Api\V1\ServerPlacedStructuresDataController;
use App\Http\Controllers\Api\V1\ServerPlayerDataController;
use App\Http\Controllers\Api\V1\ServerPlayerDeathDataController;
use App\Http\Controllers\Api\V1\ServerPlayerGatherDataController;
use App\Http\Controllers\Api\V1\ServerWeaponFireDataController;
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
        // Animal Kill Data
        Route::prefix('animalkills')->group(function () {
            Route::post('create', [ServerAnimalKillDataController::class, 'create']);
        });

        // Crafting
        Route::prefix('crafting')->group(function () {
            Route::post('create', [ServerCraftingDataController::class, 'create']);
        });

        // Destroyed Buildings
        Route::prefix('destroyedbuildings')->group(function () {
            Route::post('create', [ServerDestroyedBuildingsDataController::class, 'create']);
        });

        // Destroyed Containers
        Route::prefix('destroyedcontainers')->group(function () {
            Route::post('create', [ServerDestroyedContainersDataController::class, 'create']);
        });

        // Kills
        Route::prefix('kills')->group(function () {
            Route::post('create', [ServerKillsDataController::class, 'create']);
        });

        // Placed Deployables
        Route::prefix('placeddeployables')->group(function () {
            Route::post('create', [ServerPlacedDeployablesDataController::class, 'create']);
        });

        // Placed Structures
        Route::prefix('placedstructures')->group(function () {
            Route::post('create', [ServerPlacedStructuresDataController::class, 'create']);
        });

        // Player Data
        Route::prefix('players')->group(function () {
            Route::post('create', [ServerPlayerDataController::class, 'create']);
        });

        // Deaths
        Route::prefix('deaths')->group(function () {
            Route::post('create', [ServerPlayerDeathDataController::class, 'create']);
        });

        // Gathering
        Route::prefix('gathering')->group(function () {
            Route::post('create', [ServerPlayerGatherDataController::class, 'create']);
        });

        // Weapon Fire
        Route::prefix('weaponfire')->group(function () {
            Route::post('create', [ServerWeaponFireDataController::class, 'create']);
        });
    });
});
