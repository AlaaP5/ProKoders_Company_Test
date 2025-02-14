<?php

namespace App\Modules\UserManagementModule\Controller;

use App\Http\Controllers\Controller;
use App\Modules\UserManagementModule\Models\AddUpdateUserDto;
use App\Modules\UserManagementModule\Requests\CreateUserRequest;
use App\Modules\UserManagementModule\Requests\DeleteUserRequest;
use App\Modules\UserManagementModule\Requests\UpdateUserRequest;
use App\Modules\UserManagementModule\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function __construct(protected UserServiceInterface $userService) {}

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        return $this->userService->createUser(new AddUpdateUserDto($validated))->toJsonResponse();
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

    public function getUser(DeleteUserRequest $request) : JsonResponse
    {
        $validated = $request->validated();
        return $this->userService->getUser($validated['user_id'])->toJsonResponse();
    }

    public function updateUser(UpdateUserRequest $request) : JsonResponse
    {
        $validated = $request->validated();
        return $this->userService->updateUser(new AddUpdateUserDto($validated))->toJsonResponse();
    }
}
