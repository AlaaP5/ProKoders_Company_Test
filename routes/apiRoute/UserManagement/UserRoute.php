<?php

use Illuminate\Support\Facades\Route;
use App\Modules\UserManagementModule\Controller\UserController;


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {

        Route::get('/', [UserController::class, 'getAllUsers'])->middleware('can:get_users');
        Route::post('/create', [UserController::class, 'createUser'])->middleware('can:create_user');
    });
});
