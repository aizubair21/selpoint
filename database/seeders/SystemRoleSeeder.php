<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SystemRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $system = User::where('email', 'admin247@selpoint.com')->first();
        $systemRole = Role::where('name', 'system')->first();

        if ($system) {

            /**
             * if user have
             * give the system role to user
             * by spatie role-permision package
             */
            if (!$system->hasRole($systemRole)) {
                $system->assignRole($systemRole);
            }


            // $system->syncRole($systemRole);
        }


        // $permissions = Permission::all();
        // $permissions->syncRole($systemRole);
    }
}
