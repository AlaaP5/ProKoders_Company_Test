<?php

namespace App\Modules\TaskManagementModule\Requests;

use App\Modules\SharedModule\Request\BaseRequest;

class FilterTaskRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'page' => 'integer|max:255',
            'pageSize' => 'integer',
            'title' => 'string|max:255',
            'status' => 'in:pending,in_progress,completed'
        ]);

        $this->setMessages([
            'page.integer' => __('task.page_must_be_integer'),
            'page.max' => __('task.page_max'),

            'pageSize.integer' => __('task.pageSize_must_be_integer'),

            'title.string' => __('task.title_must_be_string'),
            'title.max' => __('task.title_max'),

            'status.in' => __('task.status_invalid'),
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
