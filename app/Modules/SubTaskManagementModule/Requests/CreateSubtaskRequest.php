<?php

namespace App\Modules\SubTaskManagementModule\Requests;

use App\Modules\SharedModule\Request\BaseRequest;

class CreateSubtaskRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'details' => 'required|string|max:255',
            'task_id' => 'required|integer|exists:tasks,id',
        ]);

        $this->setMessages([

            'details.required' => __('subtask.details_required'),
            'details.string' => __('subtask.details_string'),
            'details.max' => __('subtask.details_max'),

            'task_id.required' => __('task.task_id_required'),
            'task_id.integer' => __('task.task_id_integer'),
            'task_id.exists' => __('task.task_id_exists'),
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
