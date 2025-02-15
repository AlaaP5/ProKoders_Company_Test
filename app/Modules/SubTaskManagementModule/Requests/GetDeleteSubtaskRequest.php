<?php

namespace App\Modules\SubTaskManagementModule\Requests;

use App\Modules\SharedModule\Request\BaseRequest;

class GetDeleteSubtaskRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'subtask_id' => 'required|integer|exists:subtasks,id',
        ]);

        $this->setMessages([
            'subtask_id.required' => __('subtask.subtask_id_required'),
            'subtask_id.integer' => __('subtask.subtask_id_integer'),
            'subtask_id.exists' => __('subtask.subtask_id_exists'),
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
