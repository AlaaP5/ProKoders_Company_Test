<?php

namespace App\Modules\SharedModule\Auth\Repository;

use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(string $email, string $password): array
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();

            $user = $this->appendRolesAndPermissions($user);
            $token = $user->createToken('auth_token')->plainTextToken;
            return [
                'user' => $user,
                'token' => $token,
            ];
        }
        return [];
    }


    public function logout(): void
    {
        try {
            Auth::user()->currentAccessToken()->delete();
        } catch (Throwable $e) {
            throw new Exception(__('auth.logout_error'));
        }
    }

    public function appendRolesAndPermissions($user)
    {

        $roles = [];
        foreach ($user->roles as $role) {
            $roles[] = $role->name;
        }
        unset($user['roles']);

        $user['roles'] = $roles;


        $permissions = [];
        foreach ($user->permissions as $permission) {
            $permissions[] = $permission->name;
        }
        unset($user['permissions']);

        $user['permissions'] = $permissions;

        return $user;
    }
}
