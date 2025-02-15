<?php

namespace App\Modules\TaskManagementModule\TaskManagement\Repository;

use App\Modules\TaskManagementModule\SubtaskManagement\Models\Subtask;
use App\Modules\TaskManagementModule\TaskManagement\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Models\FilterTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Models\Task;

interface TaskRepositoryInterface
{
    function createTask(AddUpdateTaskDto $dto): Task;
    function getAllTasks(FilterTaskDto $dto): array;
    function getTask(int $id): Task;
    function deleteTask(int $id): bool;
    function updateTask(AddUpdateTaskDto $dto): Task;
    function updateTaskStatus(Subtask $subtask);
}
