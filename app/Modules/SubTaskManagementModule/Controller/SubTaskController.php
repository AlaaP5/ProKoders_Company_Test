<?php

namespace App\Modules\SubtaskManagementModule\Controller;

use App\Http\Controllers\Controller;
use App\Modules\SubtaskManagementModule\Models\AddSubtaskDto;
use App\Modules\SubtaskManagementModule\Requests\CreateSubtaskRequest;
use App\Modules\SubTaskManagementModule\Requests\GetDeleteSubtaskRequest;
use App\Modules\SubTaskManagementModule\Requests\UpdateSubtaskRequest;
use App\Modules\SubtaskManagementModule\Services\SubtaskServiceInterface;
use Illuminate\Http\JsonResponse;


class SubtaskController extends Controller
{
    public function __construct(protected SubtaskServiceInterface $subtaskService) {}

    public function createSubtask(CreateSubtaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->subtaskService
        ->createSubtask(new AddSubtaskDto($validated['details'], $validated['task_id']))->toJsonResponse();
    }


    public function deleteSubtask(GetDeleteSubtaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->subtaskService->deleteSubtask($validated['subtask_id'])->toJsonResponse();
    }

    public function getSubtask(GetDeleteSubtaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->subtaskService->getSubtask($validated['subtask_id'])->toJsonResponse();
    }

    public function updateSubtask(UpdateSubtaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->subtaskService->updateSubtask($validated['subtask_id'], $validated['status'])->toJsonResponse();
    }
}
