<?php

use Illuminate\Support\Facades\Route;
use  App\Modules\CommonModule\Auth\Controller\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::withoutMiddleware('auth:sanctum')->post('/login', [AuthController::class, 'login']);
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});
