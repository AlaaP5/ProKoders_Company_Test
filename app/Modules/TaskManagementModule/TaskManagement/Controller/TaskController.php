<?php

namespace App\Modules\TaskManagementModule\TaskManagement\Controller;

use App\Http\Controllers\Controller;
use App\Modules\TaskManagementModule\TaskManagement\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Models\FilterTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Requests\CreateTaskRequest;
use App\Modules\TaskManagementModule\TaskManagement\Requests\FilterTaskRequest;
use App\Modules\TaskManagementModule\TaskManagement\Requests\GetDeleteTaskRequest;
use App\Modules\TaskManagementModule\TaskManagement\Requests\UpdateTaskRequest;
use App\Modules\TaskManagementModule\TaskManagement\Services\TaskServiceInterface;
use Illuminate\Http\JsonResponse;


class TaskController extends Controller
{
    public function __construct(protected TaskServiceInterface $taskService) {}

    public function createTask(CreateTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->taskService->createTask(new AddUpdateTaskDto($validated))->toJsonResponse();
    }

    public function getAllTasks(FilterTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->taskService->getAllTasks(new FilterTaskDto($validated))->toJsonResponse();
    }

    public function deleteTask(GetDeleteTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->taskService->deleteTask($validated['task_id'])->toJsonResponse();
    }

    public function getTask(GetDeleteTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->taskService->getTask($validated['task_id'])->toJsonResponse();
    }

    public function updateTask(UpdateTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->taskService->updateTask(new AddUpdateTaskDto($validated))->toJsonResponse();
    }
}
