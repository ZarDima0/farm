<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('swagger', function () {

    $collections = config('openapi.collections');
    $collectionName = 'default';
    foreach ($collections as $collection => $values) {
        if ($collectionName == $collection) {
            return view('swagger-ui', ['collectionName' => $collectionName]);
        }
    }

    abort(404);
})->where([
    'uiType' => 'swagger-ui|redoc',
]);

Route::get('/', function () {
    return view('welcome');
});
