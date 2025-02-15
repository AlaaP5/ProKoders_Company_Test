<?php

namespace App\Modules\SubtaskManagementModule\Services;

use App\Modules\SharedModule\ResponseModels\ApiResponse;
use App\Modules\SubtaskManagementModule\Models\AddSubtaskDto;


interface SubtaskServiceInterface
{
    public function createSubtask(AddSubtaskDto $dto): ApiResponse;
    public function getSubtask(int $id): ApiResponse;
    public function deleteSubtask(int $id): ApiResponse;
    public function updateSubtask(int $subtask_id, string $status): ApiResponse;
}
