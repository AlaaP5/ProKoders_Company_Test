<?php

namespace App\Modules\TaskManagementModule\Controller;

use App\Http\Controllers\Controller;
use App\Modules\TaskManagementModule\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\Models\FilterTaskDto;
use App\Modules\TaskManagementModule\Requests\CreateTaskRequest;
use App\Modules\TaskManagementModule\Requests\FilterTaskRequest;
use App\Modules\TaskManagementModule\Requests\GetDeleteTaskRequest;
use App\Modules\TaskManagementModule\Requests\UpdateTaskRequest;
use App\Modules\TaskManagementModule\Services\TaskServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
