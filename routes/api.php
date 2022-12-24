<?php

use App\Http\Controllers\Building\BuildingController;
use App\Http\Controllers\FarmLand\FarmLandController;
use App\Http\Controllers\Gem\GemController;
use App\Http\Controllers\Plant\PlantController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Tree\TreeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\User\AuthController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('farmlands')->group(function () {
        Route::get('{id}/plantables/{idPlantable}', [FarmLandController::class, 'showPlantable'])->name('show.farmlands.Plantables');
        Route::get('{id}/buildings/{idBuilding}', [FarmLandController::class, 'showBuilding'])->name('show.farmlands.Building');

        Route::delete('{id}/plantables/{idPlantable}/', [FarmLandController::class, 'deletePlantable'])->name('delete.farmlands.Plantables');
        Route::delete('{id}/buildings/{idBuilding}', [FarmLandController::class, 'deleteBuilding'])->name('delete.farmlands.Building');

        Route::get('{id}/buildings', [FarmLandController::class, 'getBuildings'])->name('get.BuildingFarm.buildings');
        Route::post('{id}/buildings', [FarmLandController::class, 'createBuildings'])->name('create.BuildingFarm.buildings');

        Route::get('{id}/plantables}', [FarmLandController::class, 'getPlantables'])->name('get.farmlands.Plantables');
        Route::post('{id}/plantables', [FarmLandController::class, 'createPlantables'])->name('create.farmlands.Plantables');

        Route::post('', [FarmLandController::class, 'create']);
        Route::get('getList', [FarmLandController::class, 'getList']);
    });

    Route::prefix('plants')
        ->group(function () {
            Route::get('', [PlantController::class, 'getList']);
        });

    Route::prefix('buildings')
        ->group(function () {
            Route::get('', [BuildingController::class, 'getList']);
        });

    Route::prefix('trees')
        ->group(function () {
            Route::get('', [TreeController::class, 'getList']);
        });
    Route::prefix('gems')
        ->group(function () {
            Route::post('/buy', [GemController::class, 'buyGems'])->name('gem.buy');
        });
    Route::prefix('shop')
        ->group(function () {
            Route::post('/buy/premium', [ShopController::class, 'buyPremium'])->name('buy.premium');
            Route::get('/history', [ShopController::class, 'history'])->name('buy.history');
        });
    Route::prefix('user')
        ->group(function () {
            Route::get('/show', [UserController::class, 'show'])->name('user.show');
        });
});

Route::prefix('payments')
    ->group(function () {
        Route::post('/webhook/yooKassa', [
            GemController::class,
            'yooKassaWebhook'
        ])->name('gem.webhook');
        Route::post('/webhook/stripe', [
            GemController::class,
            'stripeWebhook'
        ])->name('gem.webhook');
    });

Route::prefix('/user')->group(callback: function () {
    Route::post('/register', [AuthController::class, 'register'])->name('user.register');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');
});

