<?php

namespace App\Modules\TaskManagementModule\SubtaskManagement\Requests;

use App\Modules\SharedModule\Request\BaseRequest;

class UpdateSubtaskRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'subtask_id' => 'required|integer|exists:subtasks,id',
            'status' => 'required|string|in:pending,in_progress,completed'
        ]);

        $this->setMessages([
            'subtask_id.required' => __('subtask.subtask_id_required'),
            'subtask_id.integer' => __('subtask.subtask_id_integer'),
            'subtask_id.exists' => __('subtask.subtask_id_exists'),

            'status.required' => __('subtask.status_required'),
            'status.string' => __('subtask.status_string'),
            'status.in' => __('subtask.status_in'),
        ]);
    }

    private function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    private function setMessages(array $messages)
    {
        $this->messages = $messages;
    }
}
