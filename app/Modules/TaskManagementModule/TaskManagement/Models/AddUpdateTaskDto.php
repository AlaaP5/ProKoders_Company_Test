<?php

namespace App\Modules\TaskManagementModule\TaskManagement\Models;

class AddUpdateTaskDto
{
    public ?int $task_id = null;
    public string $title;
    public string $description;
    public string $user_id;


    public function __construct(array $validated) {
        $this->task_id = $validated['task_id'] ?? null;
        $this->title = $validated['title'];
        $this->description = $validated['description'];
        $this->user_id = $validated['user_id'];
    }

    public function toArray(): array
    {
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => $this->user_id
        ];

        if ($this->task_id !== null) {
            $data['id'] = $this->task_id;
        }
        return $data;
    }
}
