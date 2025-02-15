<?php

use App\Modules\SubtaskManagementModule\Controller\SubtaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('subtasks')->group(function () {
        Route::post('/create', [SubtaskController::class, 'createSubtask'])->middleware('can:create_subTask');
        Route::post('/get', [SubtaskController::class, 'getSubtask']);
        Route::post('/delete', [SubtaskController::class, 'deleteSubtask'])->middleware('can:delete_subTask');
        Route::post('/update', [SubtaskController::class, 'updateSubtask']);
    });
});
