<?php

use App\Http\Controllers\Building\BuildingController;
use App\Http\Controllers\BuildingFarm\BuildingFarmController;
use App\Http\Controllers\FarmLand\FarmLandController;
use App\Http\Controllers\Plant\PlantController;
use App\Http\Controllers\Tree\TreeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\User\AuthController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('farmlands')->group(function () {


        Route::get('{id}/plantables/{idPlantable}', [FarmLandController::class, 'showPlantable'])->name('show.farmlands.Plantables');
        Route::get('{id}/buildings/{idBuilding}', [FarmLandController::class, 'showBuilding'])->name('show.farmlands.Building');

        Route::patch('{id}/plantables/{idPlantable}', [FarmLandController::class, 'editPlantable'])->name('edit.farmlands.Plantables');
        Route::patch('{id}/buildings/{idBuilding}', [FarmLandController::class, 'editBuilding'])->name('edit.farmlands.Building');

        Route::delete('{id}/plantables/{idPlantable}', [FarmLandController::class, 'deletePlantable'])->name('delete.farmlands.Plantables');
        Route::delete('{id}/buildings/{idBuilding}', [FarmLandController::class, 'deleteBuilding'])->name('delete.farmlands.Building');

        Route::get('{id}/buildings', [FarmLandController::class, 'getBuildings'])->name('get.BuildingFarm.buildings');
        Route::post('{id}/buildings', [FarmLandController::class, 'createBuildings'])->name('create.BuildingFarm.buildings');

        Route::get('{id}/plantables', [FarmLandController::class, 'getPlantables'])->name('get.farmlands.Plantables');
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
});

Route::prefix('/user')->group(callback: function () {
    Route::post('/register',[AuthController::class,'register'])->name('user.register');
    Route::post('/login',[AuthController::class,'login'])->name('user.login');
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});
