<?php

namespace App\Modules\SharedModule\UserManagement\Requests;

use App\Modules\SharedModule\Request\BaseRequest;


class DeleteUserRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'user_id' => 'required|integer|exists:users,id'
        ]);
        $this->setMessages([
            'user_id_.required' => __('auth.user_id_required'),
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
