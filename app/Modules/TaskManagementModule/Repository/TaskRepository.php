<?php

namespace App\Modules\TaskManagementModule\Repository;

use App\Modules\TaskManagementModule\Models\AddUpdateTaskDto;
use App\Modules\TaskManagementModule\Models\FilterTaskDto;
use App\Modules\TaskManagementModule\Models\Task;
use Illuminate\Support\Facades\Cache;

class TaskRepository implements TaskRepositoryInterface
{
    public function __construct(protected Task $taskModel) {}

    function createTask(AddUpdateTaskDto $dto): Task
    {
        $task = $this->taskModel->create($dto->toArray());
        $this->clearTasksCache();
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
        return $this->taskModel->findOrFail($id);
    }

    function deleteTask(int $id): bool
    {
        $result = $this->taskModel->findOrFail($id)->delete();
        $this->clearTasksCache();
        return $result;
    }

    function updateTask(AddUpdateTaskDto $dto): Task
    {
        $task = $this->getTask($dto->task_id);

        if ($dto->title) {
            $task->title = $dto->title;
        }

        if ($dto->description) {
            $task->description = $dto->description;
        }

        if ($dto->user_id) {
            $task->user_id = $dto->user_id;
        }

        $task->save();
        $this->clearTasksCache();
        return $task;
    }


    private function getTasksCacheKey(FilterTaskDto $dto): string
    {
        return 'tasks_' . md5(json_encode($dto->toArray()));
    }


    private function clearTasksCache(): void
    {
        Cache::tags(['tasks'])->flush();
    }
}
