<?php

use App\Http\Controllers\Building\BuildingController;
use App\Http\Controllers\FarmLand\FarmLandController;
use App\Http\Controllers\Plant\PlantController;
use App\Http\Controllers\Tree\TreeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\User\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('farmland')
    ->group(function () {
        Route::middleware(['auth:sanctum'])->post('', [FarmLandController::class, 'create']);
        Route::middleware(['auth:sanctum'])->get('', [FarmLandController::class, 'getList']);
    });

Route::prefix('plant')
    ->group(function () {
        Route::middleware(['auth:sanctum'])->post('', [PlantController::class, 'getList']);
    });

Route::prefix('building')
    ->group(function () {
        Route::middleware(['auth:sanctum'])->get('', [BuildingController::class, 'getList']);
    });

Route::prefix('tree')
    ->group(function () {
        Route::middleware(['auth:sanctum'])->get('', [TreeController::class, 'getList']);
    });

Route::post('/user/register',[AuthController::class,'register'])->name('user.register');
Route::post('/user/login',[AuthController::class,'login'])->name('user.login');
