<?php

use App\Http\Controllers\Building\BuildingController;
use App\Http\Controllers\FarmLand\FarmLandController;
use App\Http\Controllers\Plant\PlantController;
use App\Http\Controllers\Tree\TreeController;
use http\Client\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\User\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])
    ->prefix('farmland')
    ->group(function () {
        Route::post('', [FarmLandController::class, 'create']);
        Route::get('', [FarmLandController::class, 'getList']);
    });

Route::middleware(['auth:sanctum'])
    ->prefix('plant')
    ->group(function () {
        Route::get('', [PlantController::class, 'getList']);
    });

Route::middleware(['auth:sanctum'])
    ->prefix('building')
    ->group(function () {
        Route::get('', [BuildingController::class, 'getList']);
    });

Route::middleware(['auth:sanctum'])
    ->prefix('tree')
    ->group(function () {
        Route::get('', [TreeController::class, 'getList']);
    });

Route::post('/user/register',[AuthController::class,'register'])->name('user.register');
Route::post('/user/login',[AuthController::class,'login'])->name('user.login');
