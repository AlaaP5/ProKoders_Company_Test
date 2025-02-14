<?php

namespace App\Modules\TaskManagementModule\Models;

class FilterTaskDto
{
    public ?int $page = 1;
    public ?int $pageSize = 10;
    public ?string $title = null;
    public ?string $status = null;

    public function __construct(array $validated) {
        $this->page = $validated['page'] ?? 1;
        $this->pageSize = $validated['pageSize'] ?? 10;
        $this->title = $validated['title'] ?? null;
        $this->status = $validated['status'] ?? null;
    }

    public function toArray(): array
    {
        $data = [
            'page'=> $this->page,
            'pageSize' => $this->pageSize,
            'title' => $this->title,
            'status' => $this->status
        ];
        return $data;
    }
}
