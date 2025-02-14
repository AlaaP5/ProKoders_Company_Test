<?php

namespace App\Modules\TaskManagementModule\Requests;

use App\Modules\SharedModule\Request\BaseRequest;

class GetDeleteTaskRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'task_id' => 'required|integer|exists:tasks,id',
        ]);

        $this->setMessages([
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
