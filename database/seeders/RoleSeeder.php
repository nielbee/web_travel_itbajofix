<?php


namespace Database\Seeders; 
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // Create permissions
        $permissions = [
            'add vehicles',
            'delete vehicles',
            'payment vehicles',
            'add packages',
            'payment packages',
            'add users',
            'delete users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Give all permissions to admin
        $admin->givePermissionTo(Permission::all());

        // Give limited permissions to user
        $user->givePermissionTo(['payment vehicles', 'payment packages']);
    }
}
