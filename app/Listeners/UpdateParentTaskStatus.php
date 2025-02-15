<?php

namespace App\Listeners;

use App\Events\SubtaskStatusUpdated;
use App\Modules\TaskManagementModule\TaskManagement\Repository\TaskRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateParentTaskStatus
{
    /**
     * Create the event listener.
     */
    public function __construct(protected TaskRepositoryInterface $taskService) {}

    /**
     * Handle the event.
     */
    public function handle(SubtaskStatusUpdated $event): void
    {
        $this->taskService->updateTaskStatus($event->subtask);
    }
}
