<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PermissionsSeeder extends Seeder
{

    public function run(): void
    {
        $guard = 'web';

        $allPermissions = [
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'view_permissions',
            'create_permissions',
            'edit_permissions',
            'delete_permissions',
            'view_categories',
            'create_categories',
            'edit_categories',
            'delete_categories',
            'view_blogs',
            'create_blogs',
            'edit_blogs',
            'delete_blogs',
        ];

        foreach ($allPermissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => $guard],
                []
            );
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => $guard]);
        // $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => $guard]);
        // $employee = Role::firstOrCreate(['name' => 'editor', 'guard_name' => $guard]);

        // $editorPermissions = [
        //     'view_users',
        //     'create_users',
        //     'edit_users',
        //     'view_roles'
        // ];

        $employeePermissions = [
            'view_users',
        ];

        $admin->syncPermissions($allPermissions);
        // $editor->syncPermissions($editorPermissions);
        // $employee->syncPermissions($employeePermissions);
    }
}
