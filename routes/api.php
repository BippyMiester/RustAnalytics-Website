<?php

use App\Http\Controllers\Api\V1\ServerPlayerDataController;
use App\Models\ServerAnimalKillData;
use App\Models\ServerCraftingData;
use App\Models\ServerDestroyedBuildingsData;
use App\Models\ServerDestroyedContainersData;
use App\Models\ServerKillsData;
use App\Models\ServerPlacedDeployablesData;
use App\Models\ServerPlacedStructuresData;
use App\Models\ServerPlayerDeathData;
use App\Models\ServerPlayerGatherData;
use App\Models\ServerWeaponFireData;
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
            Route::post('create', [ServerAnimalKillData::class, 'create']);
        });

        // Crafting
        Route::prefix('crafting')->group(function () {
            Route::post('create', [ServerCraftingData::class, 'create']);
        });

        // Destroyed Buildings
        Route::prefix('destroyedbuildings')->group(function () {
            Route::post('create', [ServerDestroyedBuildingsData::class, 'create']);
        });

        // Destroyed Containers
        Route::prefix('destroyedcontainers')->group(function () {
            Route::post('create', [ServerDestroyedContainersData::class, 'create']);
        });

        // Kills
        Route::prefix('kills')->group(function () {
            Route::post('create', [ServerKillsData::class, 'create']);
        });

        // Placed Deployables
        Route::prefix('placeddeployables')->group(function () {
            Route::post('create', [ServerPlacedDeployablesData::class, 'create']);
        });

        // Placed Structures
        Route::prefix('placedstructures')->group(function () {
            Route::post('create', [ServerPlacedStructuresData::class, 'create']);
        });

        // Player Data
        Route::prefix('players')->group(function () {
            Route::post('create', [ServerPlayerDataController::class, 'create']);
        });

        // Deaths
        Route::prefix('deaths')->group(function () {
            Route::post('create', [ServerPlayerDeathData::class, 'create']);
        });

        // Gathering
        Route::prefix('gathering')->group(function () {
            Route::post('create', [ServerPlayerGatherData::class, 'create']);
        });

        // Weapon Fire
        Route::prefix('weaponfire')->group(function () {
            Route::post('create', [ServerWeaponFireData::class, 'create']);
        });
    });
});
