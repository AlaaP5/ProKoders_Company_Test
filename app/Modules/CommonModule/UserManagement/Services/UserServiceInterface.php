<?php

namespace App\Modules\CommonModule\UserManagement\Services;

use App\Modules\CommonModule\ResponseModels\ApiResponse;
use App\Modules\CommonModule\UserManagement\Models\AddUpdateUserDto;

interface UserServiceInterface
{
    function createUser(AddUpdateUserDto $dto): ApiResponse;
    function getAllUsers(int $page = 1, int $pageSize = 10, string $name = null): ApiResponse;

    function getUser(int $id): ApiResponse;
    function deleteUser(int $id): ApiResponse;
    function updateUser(AddUpdateUserDto $dto): ApiResponse;
}
