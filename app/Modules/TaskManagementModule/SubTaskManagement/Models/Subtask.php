<?php

namespace App\Modules\TaskManagementModule\SubtaskManagement\Models;

use App\Modules\TaskManagementModule\TaskManagement\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subtask extends Model
{
    use HasFactory;

    protected $fillable = ['details', 'status', 'task_id'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
