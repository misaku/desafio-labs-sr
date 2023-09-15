<?php

use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckJsonResultsController;

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
//AUTH ROUTES---------------------------------------------------------------------------------------------------------------------
Route::post('/auth', [\App\Http\Controllers\AuthController::class, 'login'])->withoutMiddleware(\App\Http\Middleware\Logger::class);
Route::middleware('auth:sanctum')->get('/auth/user', [\App\Http\Controllers\AuthController::class, 'user']);
Route::middleware('auth:sanctum')->delete('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

//PRIMO ROUTES---------------------------------------------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->post('/primo', [\App\Http\Controllers\PrimoController::class, 'store']);

//SORT ROUTES----------------------------------------------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->post('/sort', [\App\Http\Controllers\SortController::class, 'store']);

//QUESTION ROUTES------------------------------------------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->get('/question', [\App\Http\Controllers\QuestionsController::class, 'index']);

//PLACE ROUTES---------------------------------------------------------------------------------------------------------------------
Route::middleware('auth:sanctum')->post('/places', [\App\Http\Controllers\PlacesController::class, 'store']);
Route::middleware('auth:sanctum')->get('/places', [\App\Http\Controllers\PlacesController::class, 'index']);

//HEALTH ROUTES---------------------------------------------------------------------------------------------------------------------
Route::get('health', HealthCheckJsonResultsController::class);
