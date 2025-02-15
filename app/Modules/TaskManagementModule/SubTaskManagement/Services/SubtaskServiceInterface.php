<?php

namespace App\Modules\TaskManagementModule\SubtaskManagement\Services;

use App\Modules\SharedModule\ResponseModels\ApiResponse;
use App\Modules\TaskManagementModule\SubtaskManagement\Models\AddSubtaskDto;

interface SubtaskServiceInterface
{
    public function createSubtask(AddSubtaskDto $dto): ApiResponse;
    public function getSubtask(int $id): ApiResponse;
    public function deleteSubtask(int $id): ApiResponse;
    public function updateSubtask(int $subtask_id, string $status): ApiResponse;
}
