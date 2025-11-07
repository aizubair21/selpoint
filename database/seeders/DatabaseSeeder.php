<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // User::factory(10000)->create();

        // call PermissionSeeder here to create permission seeder
        $this->call(PermissionSeeder::class);

        // call role seeder here to create role seeder
        $this->call(
            RoleSeeder::class
        );

        User::factory()->create(
            [
                'name' => 'Super Admin',
                'email' => config('app.system_email'),
                'password' => bcrypt('password'),
            ]
        );

        // give all permission to system
        $this->call(SystemPermission::class);

        // give role to admin
        $this->call(SystemRoleSeeder::class);

        // system has default ref
        $this->call(SystemRefsSeeder::class);
    }
}
