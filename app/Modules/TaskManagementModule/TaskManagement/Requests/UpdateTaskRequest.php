<?php

namespace App\Modules\TaskManagementModule\TaskManagement\Requests;

use App\Modules\SharedModule\Request\BaseRequest;

class UpdateTaskRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'task_id' => 'required|integer|exists:tasks,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        $this->setMessages([
            'task_id.required' => __('task.task_id_required'),
            'task_id.integer' => __('task.task_id_integer'),
            'task_id.exists' => __('task.task_id_exists'),

            'title.string' => __('task.title_must_be_string'),
            'title.max' => __('task.title_max'),

            'description.string' => __('task.description_must_be_string'),

            'user_id.integer' => __('auth.user_id_integer'),
            'user_id.exists' => __('auth.user_id_exists'),
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
