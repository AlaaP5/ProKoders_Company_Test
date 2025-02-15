<?php

namespace App\Modules\TaskManagementModule\SubtaskManagement\Repository;

use App\Modules\TaskManagementModule\SubtaskManagement\Models\AddSubtaskDto;
use App\Modules\TaskManagementModule\SubtaskManagement\Models\Subtask;

interface SubtaskRepositoryInterface
{
    public function createSubtask(AddSubtaskDto $dto): Subtask;
    public function getSubtask(int $id): Subtask;
    public function deleteSubtask(int $id): bool;
    public function updateSubtask(int $subtask_id, string $status): Subtask;
}
