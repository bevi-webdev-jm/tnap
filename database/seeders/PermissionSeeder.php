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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions_arr = [
            'Order' => [
                'order access'      => 'Allow user to access order list and details',
                'order create'      => 'Allow user to create order.',
                'order re-order'    => 'Allow user to re-order.',
                'order cancel'      => 'Allow user to cancel order.',
                'order complete'    => 'Allow user to complete order.',
                'order history'     => 'Allow user to view order history.',
                'order report'      => 'Allow user to access order reports,',
                'order delete'      => 'Allow user to delete order.',
            ],
            'Companies' => [
                'company access'    => 'Allow user to access company list and details.',
                'company create'    => 'Allow user to create company.',
                'company edit'      => 'Allow user to edit company details.',
                'company delete'    => 'Allow user to delete company.'
            ],
            'Users' => [
                'user access'   => 'Allow user to access user list and details',
                'user create'   => 'Allow user to create user.',
                'user edit'     => 'Allow user to edit user details.',
                'user delete'   => 'Allow user to delete user.'
            ],
            'Roles' => [
                'role access'   => 'Allow user to access role list and details',
                'role create'   => 'Allow user to create role.',
                'role edit'     => 'Allow user to edit role details.',
                'role delete'   => 'Allow user to delete role.'
            ],
            'System' => [
                'system settings'   => 'Allow user to access system settings.',
                'system logs'       => 'Allow user to access system logs.'
            ]
        ];

        foreach($permissions_arr as $module => $permissions) {
            foreach($permissions as $permission => $description) {
                Permission::create([
                    'name' => $permission,
                    'module' => $module,
                    'description' => $description,
                ]);
            }
        }
    }
}
