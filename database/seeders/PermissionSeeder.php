<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin permissions
        $adminPermissions = [
            'view profile',
            'view users list',
            'view events list',
            'view announcements',
            'view announcements list',
            'view pages list',
            'view settings',
            'view permissions',
            'view roles',
            // 'view media',
            // 'view logs',
            'view reports',
            'view locations',
            'view terms-condition',
        ];

        $this->command->getOutput()->progressStart(count($adminPermissions));

        foreach ($adminPermissions as $permission) {
            // Create permission if it does not exist
            if (! Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
        $this->command->info('Admin permissions created successfully.');

        // Create or get the admin role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Fetch permissions from the database
        $adminPermissions = Permission::whereIn('name', $adminPermissions)->get();
        $adminRole->syncPermissions($adminPermissions);
        $this->command->info('Admin permissions assigned to admin role successfully.');

        // User permissions
        $userPermissions = [
            'view notifications',
            'view profile',
            'view about info',
            'view feed',
            'view search user',
            'view friends',
            'view search events',
            'view my events',
            'view joined events',
            'view messages',
            'view gallery',
            'view my pages',
            'view search pages',
            'view joined pages',
            'view page invites',
            'view interests',
            'view locations',
        ];

        $this->command->getOutput()->progressStart(count($userPermissions));

        foreach ($userPermissions as $permission) {
            // Create permission if it does not exist
            if (! Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
        $this->command->info('User permissions created successfully.');

        // Create or get the user role
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Fetch permissions from the database
        $userPermissions = Permission::whereIn('name', $userPermissions)->get();
        $userRole->syncPermissions($userPermissions);
        $this->command->info('User permissions assigned to user role successfully.');
    }
}
