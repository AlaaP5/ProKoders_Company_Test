<?php

namespace App\Modules\SubtaskManagementModule\Repository;

use App\Modules\SubtaskManagementModule\Models\AddSubtaskDto;
use App\Modules\SubtaskManagementModule\Models\Subtask;


class SubtaskRepository implements SubtaskRepositoryInterface
{
    public function __construct(protected Subtask $subtaskModel) {}


    public function createSubtask(AddSubtaskDto $dto): Subtask
    {
        return $this->subtaskModel->create($dto->toArray());
    }


    public function getSubtask(int $id): Subtask
    {
        return $this->subtaskModel->findOrFail($id);
    }


    public function deleteSubtask(int $id): bool
    {
        return $this->subtaskModel->findOrFail($id)->delete();
    }


    public function updateSubtask($id, $status): Subtask
    {
        
        $subtask = $this->getSubtask($id);

        $subtask->status = $status;
        $subtask->save();

        return $subtask;
    }
}
