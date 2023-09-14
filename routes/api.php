<?php

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
//middleware('auth:sanctum')->
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/primo', [\App\Http\Controllers\PrimoController::class, 'store'] );
Route::post('/sort', [\App\Http\Controllers\SortController::class, 'store'] );
Route::get('/question', [\App\Http\Controllers\QuestionsController::class, 'index'] );
Route::get('/places', [\App\Http\Controllers\PlacesController::class, 'index'] );
Route::post('/places', [\App\Http\Controllers\PlacesController::class, 'store'] );
