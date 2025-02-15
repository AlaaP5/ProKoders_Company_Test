<?php

namespace App\Modules\SharedModule\UserManagement\Requests;

use App\Modules\SharedModule\Request\BaseRequest;

class CreateUserRequest extends BaseRequest
{

    protected function prepareForValidation()
    {
        $this->setRules([
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        $this->setMessages([
            'name.required' => __('auth.name_required'),
            'name.string' => __('auth.name_must_be_string'),
            'name.max' => __('auth.name_max'),

            'email.required' => __('auth.email_required'),
            'email.string' => __('auth.email_must_be_string'),
            'email.unique' => __('auth.email_unique'),

            'password.required' => __('auth.password_required'),
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
