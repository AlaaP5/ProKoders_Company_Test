<?php

namespace App\Modules\SharedModule\UserManagement\Services;

use App\Modules\SharedModule\ResponseModels\ApiResponse;
use App\Modules\SharedModule\UserManagement\Models\AddUpdateUserDto;

interface UserServiceInterface
{
    function createUser(AddUpdateUserDto $dto): ApiResponse;
    function getAllUsers(int $page = 1, int $pageSize = 10, string $name = null): ApiResponse;

    function getUser(int $id): ApiResponse;
    function deleteUser(int $id): ApiResponse;
    function updateUser(AddUpdateUserDto $dto): ApiResponse;
}
