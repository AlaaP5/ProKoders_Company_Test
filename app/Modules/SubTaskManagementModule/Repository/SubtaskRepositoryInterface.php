<?php

namespace App\Modules\SubtaskManagementModule\Repository;

use App\Modules\SubtaskManagementModule\Models\AddSubtaskDto;
use App\Modules\SubtaskManagementModule\Models\Subtask;


interface SubtaskRepositoryInterface
{
    public function createSubtask(AddSubtaskDto $dto): Subtask;
    public function getSubtask(int $id): Subtask;
    public function deleteSubtask(int $id): bool;
    public function updateSubtask(int $subtask_id, string $status): Subtask;
}
