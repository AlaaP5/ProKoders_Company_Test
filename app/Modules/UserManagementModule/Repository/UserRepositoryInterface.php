<?php

namespace App\Modules\UserManagementModule\Repository;
use  App\Modules\SharedModule\Auth\Models\User;

interface UserRepositoryInterface
{
    function createUser(string $name,string $email, string $password): User;
    function getAllUsers(int $page = 1 ,int $pageSize = 10, string $name) :array;
    function deleteUser();


    function getRoleEmployee();
    function assignPermissions(array $roles, User $user);
}
