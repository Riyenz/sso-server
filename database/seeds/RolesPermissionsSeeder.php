<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::create(['name' => 'admin']);
        $user_role = Role::create(['name' => 'user']);

        $view_profile_permission = Permission::create(['name' => 'sso.profile.view']);
        $manage_profile_permission = Permission::create(['name' => 'sso.profile.manage']);

        $view_oauth_permission = Permission::create(['name' => 'sso.oauth.view']);
        $manage_oauth_permission = Permission::create(['name' => 'sso.oauth.manage']);

        $view_role_permission = Permission::create(['name' => 'sso.role.view']);
        $manage_role_permission = Permission::create(['name' => 'sso.role.manage']);

        $view_permission_permission = Permission::create(['name' => 'sso.permission.view']);
        $manage_permission_permission = Permission::create(['name' => 'sso.permission.manage']);

        $admin_role->syncPermissions([
            $view_profile_permission,
            $manage_profile_permission,
            $view_oauth_permission,
            $view_role_permission,
            $view_permission_permission,
            $manage_oauth_permission,
            $manage_role_permission,
            $manage_permission_permission
        ]);

        $user_role->syncPermissions([
            $view_profile_permission,
            $manage_profile_permission,
        ]);

        $admin = User::find(1);
        $admin->assignRole($admin_role);
    }
}
