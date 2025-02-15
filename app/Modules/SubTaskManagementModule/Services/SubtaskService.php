<?php

namespace App\Modules\SubtaskManagementModule\Services;

use App\Events\SubtaskStatusUpdatedEvent;
use App\Modules\SharedModule\ResponseModels\ApiResponse;
use App\Modules\SubtaskManagementModule\Models\AddSubtaskDto;
use App\Modules\SubtaskManagementModule\Repository\SubtaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class SubtaskService implements SubtaskServiceInterface
{
    public function __construct(private SubtaskRepositoryInterface $subtaskRepository) {}

    public function createSubtask(AddSubtaskDto $dto): ApiResponse
    {
        try {
            $subtask = $this->subtaskRepository->createSubtask($dto);
            return ApiResponse::success($subtask, __('shared.success'));
        } catch (\Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }


    public function getSubtask(int $id): ApiResponse
    {
        try {
            $subtask = $this->subtaskRepository->getSubtask($id);
            if((Auth::user()->hasRole('employee') && Auth::id() === $subtask->task->user_id) || Auth::user()->hasRole('admin')) {

            } else {
                $subtask = null;
            }
            return ApiResponse::success($subtask, __('shared.success'));

        } catch (\Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }


    public function deleteSubtask(int $id): ApiResponse
    {
        try {
            $result = $this->subtaskRepository->deleteSubtask($id);
            return ApiResponse::success($result, __('shared.success'));

        } catch (\Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }


    public function updateSubtask($id, $status): ApiResponse
    {
        DB::beginTransaction();

        try {
            $subtask_user_id = $this->subtaskRepository->getSubtask($id)->task->user_id;

            if((Auth::user()->hasRole('employee') && Auth::id() === $subtask_user_id) || Auth::user()->hasRole('admin')) {
                $subtask = $this->subtaskRepository->updateSubtask($id, $status);

                $subtask = $subtask->makeHidden('task');

                Event::dispatch(new SubtaskStatusUpdatedEvent($subtask));
                DB::commit();

            } else {
                $subtask = null;
            }

            return ApiResponse::success($subtask, __('shared.success'));

        } catch (\Throwable $e) {
            DB::rollBack();
            return ApiResponse::error(__('shared.general_error'));
        }
    }
}
