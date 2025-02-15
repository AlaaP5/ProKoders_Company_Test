<?php

use App\Modules\SharedModule\UserManagement\Controller\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {

        Route::get('/', [UserController::class, 'getAllUsers'])->middleware('can:get_users');
        Route::post('/create', [UserController::class, 'createUser'])->middleware('can:create_user');
        Route::post('/get', [UserController::class, 'getUser']);
        Route::post('/delete', [UserController::class, 'deleteUser'])->middleware('can:delete_user');
        Route::post('/update', [UserController::class, 'updateUser'])->middleware('can:update_user');
    });
});
