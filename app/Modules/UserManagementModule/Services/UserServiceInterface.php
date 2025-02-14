<?php

namespace App\Modules\UserManagementModule\Services;

use App\Modules\SharedModule\ResponseModels\ApiResponse;

interface UserServiceInterface
{
    function createUser(string $name, string $email, string $password): ApiResponse;
    function getAllUsers(int $page = 1, int $pageSize = 10, string $name = null): ApiResponse;

    function deleteUser(int $id): ApiResponse;
}
