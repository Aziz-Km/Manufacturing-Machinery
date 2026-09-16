<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $engineerRole = Role::create(['name' => 'Engineer']);
        $viewerRole = Role::create(['name' => 'Viewer']);

        // Assign Admin role to our default admin user
        $adminUser = User::where('email', 'admin@jowfe.com')->first();
        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }
    }
}
