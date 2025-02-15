<?php

namespace App\Modules\TaskManagementModule\TaskManagement\Services;

use App\Modules\SharedModule\ResponseModels\ApiResponse;
use App\Modules\TaskManagementModule\TaskManagement\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Models\FilterTaskDto;

interface TaskServiceInterface
{
    function createTask(AddUpdateTaskDto $dto): ApiResponse;
    function getAllTasks(FilterTaskDto $dto): ApiResponse;
    function getTask(int $id): ApiResponse;
    function deleteTask(int $id): ApiResponse;
    function updateTask(AddUpdateTaskDto $dto): ApiResponse;
}
