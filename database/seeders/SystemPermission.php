<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SystemPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all permision and assign then into 'system' role
        $permissions = Permission::get('name');
        $system = Role::where('name', 'system')->first();
        if (!$system) {
            $system = Role::create(['name' => 'system']);
        }

        // if permission is not assigned to system role, assign it
        if ($permissions) {
            foreach ($permissions as $permission) {
                if (!$system->hasPermissionTo($permission->name)) {
                    $system->givePermissionTo($permission->name);
                }
            }
        }

        // $system->syncPermissions($permissions);
    }
}
