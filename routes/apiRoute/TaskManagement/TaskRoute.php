<?php

use App\Modules\TaskManagementModule\Controller\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('tasks')->group(function () {

        Route::get('/', [TaskController::class, 'getAllTasks'])->middleware('can:get_tasks');
        Route::post('/create', [TaskController::class, 'createTask'])->middleware('can:create_task');
        Route::post('/get', [TaskController::class, 'getTask']);
        Route::post('/delete', [TaskController::class, 'deleteTask'])->middleware('can:delete_task');
        Route::post('/update', [TaskController::class, 'updateTask'])->middleware('can:update_task');
    });
});

