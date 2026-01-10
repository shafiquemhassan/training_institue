<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class AdminPermissionsSeeder extends Seeder
{
    
    public function run(): void
    {
       
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        $adminRole->syncPermissions(Permission::all());

        $adminEmail = env('ADMIN_EMAIL');

        if($adminEmail && ($user = User::where('email', $adminEmail)->first())){
            $user->syncRoles([$adminRole->name]);
        }
    }
}
