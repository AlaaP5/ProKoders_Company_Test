<?php

namespace App\Modules\TaskManagementModule\TaskManagement\Services;

use App\Modules\CommonModule\ResponseModels\ApiResponse;
use App\Modules\TaskManagementModule\TaskManagement\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Models\FilterTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Repository\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class TaskService implements TaskServiceInterface
{
    public function __construct(private TaskRepositoryInterface $taskRepository) {}

    function createTask(AddUpdateTaskDto $dto): ApiResponse
    {
        try {
            $task = $this->taskRepository->createTask($dto);
            return ApiResponse::success($task, __('shared.success'));
        } catch (Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }

    function getAllTasks(FilterTaskDto $dto): ApiResponse
    {
        try {
            $tasks = $this->taskRepository->getAllTasks($dto);
            return ApiResponse::success($tasks['data'], __('shared.success'), $tasks['total'], $tasks['current_page']);

        } catch (Throwable $e) {
            Log::error('Error fetching tasks: ' . $e->getMessage(), [
                'exception' => $e,
                'dto' => $dto
            ]);
            return ApiResponse::error(__('shared.general_error'));
        }
    }

    function getTask(int $id): ApiResponse
    {
        try {

            $task = $this->taskRepository->getTask($id);
            if((Auth::user()->hasRole('employee') && Auth::id() === $task->user_id) || Auth::user()->hasRole('admin')) {

            } else {
                $task = null;
            }
            return ApiResponse::success($task, __('shared.success'));

        } catch (Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }


    function deleteTask(int $id): ApiResponse
    {
        try {
            $result = $this->taskRepository->deleteTask($id);
            return ApiResponse::success($result, __('shared.success'));
        } catch (Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }

    function updateTask(AddUpdateTaskDto $dto): ApiResponse
    {
        try {
            $task = $this->taskRepository->updateTask($dto);
            return ApiResponse::success($task, __('shared.success'));
        } catch (Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }
}
