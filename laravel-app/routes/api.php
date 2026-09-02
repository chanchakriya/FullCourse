<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/signout', [AuthController::class, 'signout'])->middleware('auth:sanctum');
Route::get('/verify', [AuthController::class, 'verify'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    route::post('/signout', [AuthController::class, 'signout']);
    route::post('/verify', [AuthController::class, 'verify']);
});