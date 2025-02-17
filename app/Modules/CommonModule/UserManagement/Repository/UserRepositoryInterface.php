<?php

namespace App\Modules\CommonModule\UserManagement\Repository;
use App\Modules\CommonModule\Auth\Models\User;
use App\Modules\CommonModule\UserManagement\Models\AddUpdateUserDto;

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
