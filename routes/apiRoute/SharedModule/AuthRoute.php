<?php

use Illuminate\Support\Facades\Route;
use  App\Modules\SharedModule\Auth\Controller\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::withoutMiddleware('auth:sanctum')->post('/login', [AuthController::class, 'login']);
        Route::middleware('can:logout')->get('/logout', [AuthController::class, 'logout']);
    });
});
