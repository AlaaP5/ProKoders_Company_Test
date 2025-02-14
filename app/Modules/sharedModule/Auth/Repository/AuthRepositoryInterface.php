<?php
namespace App\Modules\SharedModule\Auth\Repository;

use App\Modules\SharedModule\Auth\Models\User;

interface AuthRepositoryInterface
{
    function login(string $email, string $password): array;
    function logout(): void;
    function appendRolesAndPermissions(User $user);
}

