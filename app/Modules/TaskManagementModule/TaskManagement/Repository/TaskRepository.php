<?php

namespace App\Modules\TaskManagementModule\TaskManagement\Repository;

use App\Modules\TaskManagementModule\TaskManagement\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Models\FilterTaskDto;
use App\Modules\TaskManagementModule\TaskManagement\Models\Task;
use Illuminate\Support\Facades\Cache;


class TaskRepository implements TaskRepositoryInterface
{
    public function __construct(protected Task $taskModel) {}

    function createTask(AddUpdateTaskDto $dto): Task
    {
        $task = $this->taskModel->create($dto->toArray());
        Cache::flush();
        return $task;
    }


    function getAllTasks(FilterTaskDto $dto): array
    {

        $cacheKey = 'tasks_' . md5(json_encode($dto));

        $tasks = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($dto) {
            $query = $this->taskModel->with('subtasks:title,status')->newQuery();

            if ($dto->title) {
                $query->where('title', 'like', "%{$dto->title}%");
            }

            if ($dto->status) {
                $query->where('status', $dto->status);
            }

            return $query->paginate($dto->pageSize, ['*'], 'page', $dto->page)->toArray();
        });

        return $tasks;
    }


    function getTask(int $id): Task
    {
        return $this->taskModel->where('id', $id)->with('subtasks')->first();
    }

    function deleteTask(int $id): bool
    {
        $result = $this->taskModel->findOrFail($id)->delete();
        Cache::flush();
        return $result;
    }

    function updateTask(AddUpdateTaskDto $dto): Task
    {
        $task = $this->getTask($dto->task_id);

        $task->update($dto->toArray());

        Cache::flush();
        return $task;
    }
}
