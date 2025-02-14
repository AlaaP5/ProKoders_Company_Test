<?php

namespace App\Modules\TaskManagementModule\Services;

use App\Modules\SharedModule\ResponseModels\ApiResponse;
use App\Modules\TaskManagementModule\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\Models\FilterTaskDto;

interface TaskServiceInterface
{
    function createTask(AddUpdateTaskDto $dto): ApiResponse;
    function getAllTasks(FilterTaskDto $dto): ApiResponse;
    function getTask(int $id): ApiResponse;
    function deleteTask(int $id): ApiResponse;
    function updateTask(AddUpdateTaskDto $dto): ApiResponse;
}
