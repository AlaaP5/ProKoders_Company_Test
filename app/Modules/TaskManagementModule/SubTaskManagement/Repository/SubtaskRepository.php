<?php

namespace App\Modules\TaskManagementModule\SubtaskManagement\Repository;

use App\Modules\TaskManagementModule\SubtaskManagement\Models\AddSubtaskDto;
use App\Modules\TaskManagementModule\SubtaskManagement\Models\Subtask;
use Illuminate\Support\Facades\Cache;

class SubtaskRepository implements SubtaskRepositoryInterface
{
    public function __construct(protected Subtask $subtaskModel) {}


    public function createSubtask(AddSubtaskDto $dto): Subtask
    {
        Cache::flush();
        return $this->subtaskModel->create($dto->toArray());
    }


    public function getSubtask(int $id): Subtask
    {
        return $this->subtaskModel->findOrFail($id);
    }


    public function deleteSubtask(int $id): bool
    {
        Cache::flush();
        return $this->subtaskModel->findOrFail($id)->delete();
    }


    public function updateSubtask($id, $status): Subtask
    {

        $subtask = $this->getSubtask($id);

        $subtask->status = $status;
        $subtask->save();

        Cache::flush();
        return $subtask;
    }
}
