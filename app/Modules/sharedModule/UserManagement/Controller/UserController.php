<?php

namespace App\Modules\SharedModule\UserManagement\Controller;

use App\Http\Controllers\Controller;
use App\Modules\SharedModule\UserManagement\Models\AddUpdateUserDto;
use App\Modules\SharedModule\UserManagement\Requests\CreateUserRequest;
use App\Modules\SharedModule\UserManagement\Requests\DeleteUserRequest;
use App\Modules\SharedModule\UserManagement\Requests\UpdateUserRequest;
use App\Modules\SharedModule\UserManagement\Services\UserServiceInterface;
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
