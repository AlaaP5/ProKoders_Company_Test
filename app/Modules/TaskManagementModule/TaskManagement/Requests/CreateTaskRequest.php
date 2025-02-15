<?php

namespace App\Modules\TaskManagementModule\TaskManagement\Requests;

use App\Modules\SharedModule\Request\BaseRequest;

class CreateTaskRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $this->setMessages([

            'title.required' => __('task.required'),
            'title.string' => __('task.title_must_be_string'),
            'title.max' => __('task.title_max'),

            'description.required' => __('task.required'),
            'description.string' => __('task.description_must_be_string'),

            'user_id.required' => __('auth.user_id_required'),
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
