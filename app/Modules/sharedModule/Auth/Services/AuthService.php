<?php

namespace App\Modules\SharedModule\Auth\Services;

use App\Modules\SharedModule\ResponseModels\ApiResponse;
use App\Modules\SharedModule\Auth\Repository\AuthRepositoryInterface;
use Throwable;

class AuthService implements AuthServiceInterface
{

    public function __construct(protected AuthRepositoryInterface $authRepository) {}

    function login(string $email, string $password): ApiResponse
    {
        try {
            $result = $this->authRepository->login($email, $password);

            if (empty($result)) {
                return ApiResponse::error(__('auth.invalid_credentials'));
            }
            return ApiResponse::success($result,  __('auth.login_success'));
        } catch (Throwable $e) {
            return ApiResponse::error(__('auth.login_error'));
        }
    }

    function logout(): ApiResponse
    {
        try {
            $this->authRepository->logout();
            return ApiResponse::success(null, "");
        } catch (Throwable $e) {
            return ApiResponse::error($e->getMessage());
        }
    }
}
