<?php

namespace App\Modules\SharedModule\UserManagement\Repository;

use  App\Modules\SharedModule\Auth\Models\User;
use App\Modules\SharedModule\UserManagement\Models\AddUpdateUserDto;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected User $userModel) {}


    function createUser(AddUpdateUserDto $dto): User
    {
        $dto->password = Hash::make($dto->password);
        return $this->userModel->create($dto->toArray());
    }


    function getAllUsers(int $page = 1, int $pageSize = 10, string $name = null): array
    {
        $query =  $this->userModel->select(['id', 'name', 'email'])->newQuery();

        if ($name) {
            $query->where('name', 'like', "%{$name}%");
        }
        // dd($query->paginate($pageSize,  ['*'], 'page', $page)->toArray());

        return $query->paginate($pageSize,  ['*'], 'page', $page)->toArray();
    }


    function deleteUser(int $id): bool
    {
        return $this->userModel->findOrFail($id)->delete();
    }


    function getUser(int $id): User
    {
        return $this->userModel->findOrFail($id);
    }

    function updateUser(AddUpdateUserDto $dto): User
    {
        $user = $this->getUser($dto->user_id);

        $dto->password = Hash::make($dto->password);
        $user->update($dto->toArray());

        return $user;
    }


    function getRoleEmployee()
    {
        return Role::where('name', 'employee')->first();
    }

    function assignPermissions($roles, $user)
    {
        $user->assignRole($roles);

        $permissions = $roles->permissions()->pluck('name')->toArray();
        $user->givePermissionTo($permissions);
        return true;
    }
}
