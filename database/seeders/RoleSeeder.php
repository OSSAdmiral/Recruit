<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*--
        * Create  Permission
        *--*/
        $arrayOfPermissionNames = ['Add Role', 'Delete Role', 'Add User', 'Delete User', 'View User', 'View Role', 'View Profile', 'View Permissions'];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'api'];
        });
        Permission::insert($permissions->toArray());

        /*--
        * Roles and Permission For Users
        *--*/
        Role::create(['name' => 'SUPER_USER'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'USER'])->givePermissionTo(['View Profile']);
        Role::create(['name' => 'ADMIN'])->givePermissionTo(['Add Role', 'Add User', 'View User', 'View Role', 'View Profile']);

    }
}
