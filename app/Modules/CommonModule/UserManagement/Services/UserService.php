<?php

namespace App\Modules\CommonModule\UserManagement\Services;

use App\Modules\CommonModule\Auth\Repository\AuthRepositoryInterface;
use App\Modules\CommonModule\ResponseModels\ApiResponse;
use App\Modules\CommonModule\UserManagement\Models\AddUpdateUserDto;
use App\Modules\CommonModule\UserManagement\Repository\UserRepositoryInterface;
use App\Modules\CommonModule\UserManagement\Services\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use Throwable;


class UserService implements UserServiceInterface
{

    public function __construct(private UserRepositoryInterface $userRepository, private AuthRepositoryInterface $authRepository) {}

    function createUser(AddUpdateUserDto $dto): ApiResponse
    {
        try {
            $user = $this->userRepository->createUser($dto);

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
            $result = $this->userRepository->deleteUser($id);
            return ApiResponse::success($result, __('shared.success'));

        } catch (Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }

    function getUser(int $id): ApiResponse
    {
        try {
            if((Auth::user()->hasRole('employee') && Auth::id() === $id) || Auth::user()->hasRole('admin')) {
                $result = $this->userRepository->getUser($id);

            } else {
                $result = null;
            }
            return ApiResponse::success($result, __('shared.success'));

        } catch (Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }

    }

    function updateUser(AddUpdateUserDto $dto): ApiResponse
    {
        try{
            $user = $this->userRepository->updateUser($dto);

            return ApiResponse::success($user, __('shared.success'));

        } catch(Throwable $e) {
            return ApiResponse::error(__('shared.general_error'));
        }
    }
}
