<?php

namespace App\Modules\SubTaskManagementModule\Models;

use App\Modules\TaskManagementModule\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subtask extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status', 'task_id'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
