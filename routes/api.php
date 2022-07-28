<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AdvertisersController;
use App\Http\Controllers\AdvsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//------categories routes---------
Route::resource('categories', CategoriesController::class);

//------categories routes---------
Route::resource('advertisers', AdvertisersController::class);

//------tags routes---------
Route::resource('tags', TagsController::class);

//------advs routes---------
Route::resource('advs', AdvsController::class);

//------advs getByCategory---------
Route::get('getByCategory/{category}', [AdvsController::class, 'getByCategory']);

//------advs getByTag---------
Route::get('getByTag/{tag}', [AdvsController::class, 'getByTag']);
