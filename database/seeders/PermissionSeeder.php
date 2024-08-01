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

        $this->command->info('Creating user permissions...');
        $permissions = [
            'view profile',
            'view announcements',
            'view about info',
            'view feed',
            'view notifications',
            'view search user',
            'view firends',
            'view search events',
            'view my events',
            'view joined events',
            'view messages',
            'view gallery',
            'view my pages',
            'view search pages',
            'view joined pages',
            'view page invites',
        ];

        $this->command->getOutput()->progressStart(count($permissions));

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
        $this->command->info('Permissions for user created successfully.');

        $this->command->info('Assigning user permissions to user role...');
        $role = Role::where('name', 'user')->first();
        $role->syncPermissions($permissions);
        $this->command->info('User permissions assigned to user role successfully.');

        $this->command->info('Creating admin permissions...');
        $permissions = [
            'view users list',
            'view events list',
            'view announcements list',
            'view pages list',
            'view settings',
            'view permissions',
            'view roles',
            'view media',
            'view logs',
            'view reports',
        ];

        $this->command->getOutput()->progressStart(count($permissions));

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
        $this->command->info('Permissions for admin created successfully.');

        $this->command->info('Assigning admin permissions to admin role...');
        $role = Role::where('name', 'admin')->first();
        $role->syncPermissions($permissions);
        $this->command->info('Admin permissions assigned to admin role successfully.');
    }
}
