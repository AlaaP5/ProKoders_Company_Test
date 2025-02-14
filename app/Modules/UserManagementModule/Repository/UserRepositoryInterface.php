<?php

namespace App\Modules\UserManagementModule\Repository;
use  App\Modules\SharedModule\Auth\Models\User;
use App\Modules\UserManagementModule\Models\AddUpdateUserDto;

interface UserRepositoryInterface
{
    function createUser(AddUpdateUserDto $dto): User;
    function getAllUsers(int $page = 1 ,int $pageSize = 10, string $name) :array;
    function deleteUser(int $id): bool;
    function getUser(int $id): User;
    function updateUser(AddUpdateUserDto $dto): User;


    function getRoleEmployee();
    function assignPermissions(array $roles, User $user);
}
