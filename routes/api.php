<?php

use App\Http\Controllers\Building\BuildingController;
use App\Http\Controllers\FarmLand\FarmLandController;
use App\Http\Controllers\Plant\PlantController;
use App\Http\Controllers\Tree\TreeController;
use http\Client\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\User\AuthController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('farmlands')->group(function () {
        Route::post('', [FarmLandController::class, 'create']);
        Route::get('', [FarmLandController::class, 'getList']);
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
