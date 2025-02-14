<?php

namespace App\Modules\UserManagementModule\Repository;

use  App\Modules\SharedModule\Auth\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected User $userModel) {}

    function createUser(string $name, string $email, string $password): User
    {

        return $this->userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
    }

    function getAllUsers(int $page = 1, int $pageSize = 10, string $name = null): array
    {
        $query =  $this->userModel->with(['roles:name', 'permissions:name'])->select(['id', 'name', 'email'])->newQuery();

        if ($name) {
            $query->where('name', 'like', "%{$name}%");
        }
        // dd($query->paginate($pageSize,  ['*'], 'page', $page)->toArray());

        return $query->paginate($pageSize,  ['*'], 'page', $page)->toArray();
    }

    function deleteUser()
    {
        
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
