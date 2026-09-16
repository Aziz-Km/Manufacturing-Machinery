<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddGranularPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage_factories',
            'manage_machines',
            'manage_engineers',
            'manage_catalogs',
            'manage_tasks',
            'manage_users'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to Admin
        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $adminRole->syncPermissions(Permission::all());
        }
    }
}
