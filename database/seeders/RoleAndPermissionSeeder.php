<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // Booking permissions
            'view bookings',
            'create bookings',
            'edit bookings',
            'delete bookings',
            'update booking status',

            // China Warehouse Specific
            'measure booking',
            'update booking price',
            'manage china statuses',

            // BD Warehouse Specific
            'manage bd statuses',
            'manage payments',
            'manage delivery',

            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',

            // Settings
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // Create Roles and Assign Permissions

        // Super Admin
        $superAdminRole = Role::findOrCreate('Super Admin', 'web');
        $superAdminRole->givePermissionTo(Permission::all());

        // China Warehouse Manager
        $chinaManagerRole = Role::findOrCreate('China Warehouse Manager', 'web');
        $chinaManagerRole->givePermissionTo([
            'view bookings',
            'update booking status',
            'measure booking',
            'update booking price',
            'manage china statuses',
        ]);

        // BD Warehouse Manager
        $bdManagerRole = Role::findOrCreate('BD Warehouse Manager', 'web');
        $bdManagerRole->givePermissionTo([
            'view bookings',
            'update booking status',
            'manage bd statuses',
            'manage payments',
            'manage delivery',
        ]);
    }
}
