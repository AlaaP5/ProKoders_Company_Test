<?php

namespace App\Modules\SharedModule\UserManagement\Models;

class AddUpdateUserDto
{
    public ?int $user_id = null;
    public string $name;
    public string $email;
    public string $password;

    public function __construct(array $validated) {
        $this->user_id = $validated['user_id'] ?? null;
        $this->name = $validated['name'];
        $this->email = $validated['email'];
        $this->password = $validated['password'];

    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];

        if ($this->user_id !== null) {
            $data['id'] = $this->user_id;
        }
        return $data;
    }
}
