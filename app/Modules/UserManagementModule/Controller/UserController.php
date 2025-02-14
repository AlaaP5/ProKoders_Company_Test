<?php

namespace App\Modules\UserManagementModule\Controller;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteUserRequest;
use App\Modules\UserManagementModule\Requests\CreateUserRequest;
use App\Modules\UserManagementModule\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function __construct(protected UserServiceInterface $userService) {}

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->userService->createUser($validated['name'], $validated['email'], $validated['password'])->toJsonResponse();
    }

    public function getAllUsers(Request $request): JsonResponse
    {
        return $this->userService->getAllUsers($request->input('page') ? $request->input('page') : 1 , $request->input('pageSize') ? $request->input('pageSize') : 10 , $request->input('name'))->toJsonResponse();
    }

    public function deleteUser(DeleteUserRequest $request) : JsonResponse
    {
        $validated = $request->validated();
        return $this->userService->deleteUser($validated['user_id'])->toJsonResponse();
    }
}
