<?php

namespace App\Listeners;

use App\Events\SubtaskStatusUpdated;
use App\Modules\TaskManagementModule\Jobs\SendNotificationJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateParentTaskStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SubtaskStatusUpdated $event): void
    {
        $task = $event->subtask->task;
        $subtasks = $task->subtasks;

        if ($subtasks->every(fn ($subtask) => $subtask->status === 'completed')) {
            $task->status = 'completed';

            dispatch(new SendNotificationJob($task));

        } elseif ($subtasks->contains(fn ($subtask) => $subtask->status === 'in_progress')) {
            $task->status = 'in_progress';

        } elseif ($subtasks->every(fn ($subtask) => $subtask->status === 'pending')) {
            $task->status = 'pending';

        } else {
            $task->status = 'in_progress';
        }

        $task->save();
    }
}
