<?php

namespace App\Modules\CommonModule\UserManagement\Requests;

use App\Modules\CommonModule\Request\BaseRequest;


class UpdateUserRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'string|max:255',
            'email' => 'string|unique:users,email',
            'password' => 'string|min:6',
        ]);
        $this->setMessages([
            'user_id_.required' => __('auth.user_id_required'),
            'user_id.integer' => __('auth.user_id_integer'),
            'user_id.exists' => __('auth.user_id_exists'),

            'name.string' => __('auth.name_must_be_string'),
            'name.max' => __('auth.name_max'),

            'email.string' => __('auth.email_must_be_string'),
            'email.unique' => __('auth.email_unique'),

            'password.string' => __('auth.password_must_be_string'),
            'password.min' => __('auth.password_min'),
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
