<?php

use App\Http\Controllers\BreedController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\CatImageController;
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

// API Routes for Cat operations
Route::apiResource('cats', CatController::class);

Route::get('/cat-image', [CatImageController::class, 'fetch']);

// API Routes for Breed operations
Route::apiResource('breeds', BreedController::class);

