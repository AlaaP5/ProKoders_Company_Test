<?php

namespace App\Modules\CommonModule\Auth\DataBaseSeeders;

use App\Modules\CommonModule\Auth\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create roles
        $admin_role = Role::create(['name' => 'admin']);
        $employee_role = Role::create(['name' => 'employee']);

        // define permissions
        $permissions = [
            'login', 'logout', 'create_user', 'get_user', 'update_user', 'delete_user', 'get_users',
            'create_task', 'get_task', 'update_task', 'delete_task', 'get_tasks',
            'create_subTask', 'get_subTask', 'update_subTask', 'delete_subTask'
        ];

        foreach($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }


        $admin_role->syncPermissions($permissions);

        $employee_role->givePermissionTo(['get_subTask', 'update_subTask', 'login', 'logout']);


        $admin_user = User::create([
            'name' => 'admin',
            'email' => 'admin@proKoders.com',
            'password' => bcrypt('@admin12'),
        ]);
        $admin_user->assignRole($admin_role);


        $admin_permissions= $admin_role->permissions()->pluck('name')->toArray();
        $admin_user->givePermissionTo($admin_permissions);


        $employee_user = User::create([
            'name' => 'user',
            'email' => 'user@proKoders.com',
            'password' => bcrypt('@user12'),
        ]);
        $employee_user->assignRole($employee_role);

        $user_permissions = $employee_role->permissions()->pluck('name')->toArray();
        $employee_user->givePermissionTo($user_permissions);
    }
}
