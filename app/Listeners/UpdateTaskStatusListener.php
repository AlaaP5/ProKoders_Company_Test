<?php

namespace App\Listeners;

use App\Events\SubtaskStatusUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTaskStatusListener
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
    public function handle(SubtaskStatusUpdatedEvent $event): void
    {
        $task = $event->subtask->task;
        $subtasks = $task->subtasks;

        if ($subtasks->every(fn ($subtask) => $subtask->status === 'completed')) {
            $task->status = 'completed';

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
