<?php

namespace App\Modules\UserManagementModule\Services;

use App\Modules\SharedModule\Auth\Repository\AuthRepositoryInterface;
use App\Modules\SharedModule\ResponseModels\ApiResponse;
use App\Modules\UserManagementModule\Repository\UserRepositoryInterface;
use App\Modules\UserManagementModule\Services\UserServiceInterface;
use Throwable;


class UserService implements UserServiceInterface
{

    public function __construct(private UserRepositoryInterface $userRepository, private AuthRepositoryInterface $authRepository) {}

    function createUser(string $name, string $email, string $password): ApiResponse
    {
        try {
            $user = $this->userRepository->createUser($name, $email, $password);

            $employeeRole = $this->userRepository->getRoleEmployee();

            $this->userRepository->assignPermissions($employeeRole, $user);

            $user = $this->authRepository->appendRolesAndPermissions($user);

            return ApiResponse::success($user, __('shared.success'));

        } catch (Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }

    function getAllUsers(int $page = 1, int $pageSize = 10, string $name = null): ApiResponse
    {
        try {
            $users = $this->userRepository->getAllUsers($page, $pageSize, $name);
            return ApiResponse::success($users['data'], __('shared.success'), $users['total'], $users['current_page']);
        } catch (Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }

    function deleteUser(int $id): ApiResponse
    {
        try {

            return ApiResponse::success('', __('shared.success'));

        } catch (Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }
}
