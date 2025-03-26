<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permission create 
        $permissions = [
            'role-navigation',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-manage',

            'permission-navigation',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'permission-manage',

            'access_admin_section',
            'access_vendor_section',
            'access_reseller_section',
            'access_users_section',
            'access_rider_section',
            'access_comision_section',
            'access_withdraw_section',
            'access_role_section',
            'access_permission_section',

            'access_users_dashbobard',
            'access_admin_dashboard',
            'access_vendor_dashboard',
            'access_reseller_dashboard',
            'access_rider_dashboard',

            'admin_navigation',
            'admin_manage',
            'admin_add',
            'admin_edit',
            'admin_update',
            'admin_delete',

            //for admin 
            'vendor_navigation',
            'vendor-manage',
            'vendor_view',
            'vendor_add',
            'vendor_edit',
            'vendor_delelte',
            'vendor_update',

            'reseller_navigation',
            'reseller_view',
            'reseller_add',
            'reseller_edit',
            'reseller_delete',
            'reseller_update',
            'reseller_manage',

            'rider_navigation',
            'rider_view',
            'rider_add',
            'rider_edit',
            'rider_update',
            'rider_delete',

            'users_navigation',
            'users_view',
            'users-manage',
            'users_add',
            'users_edit',
            'users_delete',
            //for admin

            'category_view',
            'category_add',
            'category_edit',
            'category_update',
            'category_delete',

            'product_view',
            'product_add',
            'product_edit',
            'product_update',
            'product_delete',

        ];

        foreach ($permissions as $value) {
            Permission::create(['name' => $value]);
        }
    }
}
