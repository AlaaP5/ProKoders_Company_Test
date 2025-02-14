<?php

namespace App\Modules\SharedModule\Auth\Controller;

use App\Modules\SharedModule\Auth\Requests\LoginRequest;
use App\Modules\SharedModule\Auth\Services\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function __construct(protected AuthServiceInterface $authService) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->authService->login($validated['email'], $validated['password'])->toJsonResponse();
    }

    public function logout(): JsonResponse
    {

        return $this->authService->logout()->toJsonResponse();
    }
}
