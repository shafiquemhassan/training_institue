<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionsSeeder::class,
        ]);

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin@123')
        ]);
        $admin->assignRole('admin');

        $editor = User::factory()->create([
            'name' => 'editor',
            'email' => 'editor@example.com',
            'password' => bcrypt('editor@123')
        ]);
        $editor->assignRole('editor');

        $employee = User::factory()->create([
            'name' => 'employee',
            'email' => 'employee@example.com',
            'password' => bcrypt('employee@123')
        ]);
        $employee->assignRole('employee');
    }
}
