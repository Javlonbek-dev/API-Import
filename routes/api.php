<?php

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/post', PostController::class);
Route::post('/register', [AuthenController::class, 'register']);
Route::post('/login', [AuthenController::class, 'login']);
Route::middleware('auth:api')->get('/user', [AuthenController::class, 'user']);
