<?php

namespace App\Modules\TaskManagementModule\Repository;

use App\Modules\TaskManagementModule\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\Models\FilterTaskDto;
use App\Modules\TaskManagementModule\Models\Task;

interface TaskRepositoryInterface
{
    function createTask(AddUpdateTaskDto $dto): Task;
    function getAllTasks(FilterTaskDto $dto): array;
    function getTask(int $id): Task;
    function deleteTask(int $id): bool;
    function updateTask(AddUpdateTaskDto $dto): Task;
}
