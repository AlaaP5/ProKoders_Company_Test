<?php

namespace App\Modules\SubtaskManagementModule\Models;

class AddSubtaskDto
{
    public function __construct(
        public string $details,
        public int $task_id,
        public ?string $status = 'pending'
    ) {}

    public function toArray(): array
    {
        return [
            'details' => $this->details,
            'task_id' => $this->task_id,
            'status' => $this->status
        ];
    }
}
