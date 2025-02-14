<?php

namespace App\Modules\SharedModule\Auth\Requests;

use App\Modules\SharedModule\Request\BaseRequest;

class LoginRequest extends BaseRequest
{
    protected function prepareForValidation()
    {
        $this->setRules([
            'email' => 'required|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        $this->setMessages([
            'email.required' => __('auth.email_required'),
            'email.exists' => __('auth.email_exists'),
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
