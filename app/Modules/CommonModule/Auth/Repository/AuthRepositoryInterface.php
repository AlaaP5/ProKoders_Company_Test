<?php
namespace App\Modules\CommonModule\Auth\Repository;

use App\Modules\CommonModule\Auth\Models\User;

interface AuthRepositoryInterface
{
    function login(string $email, string $password): array;
    function logout(): void;
    function appendRolesAndPermissions(User $user);
}

