<?php

namespace App\TaskManagementModule\Jobs;

use App\Modules\TaskManagementModule\TaskManagement\Models\Task;
use App\TaskManagementModule\Mail\SendMail;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Task $task) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->task->user->email)->send(new SendMail($this->task));
    }

    // public function failed(Exception $exception)
    // {

    // }

    // public function retryAfter()
    // {
    //     return 2;
    // }
}
