<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // User::factory(10)->create();

       $admin = User::factory()->create([
            'name' => 'administrator',
            'email' => 'admin@mytravel.com',
            'password' => bcrypt('@admin1234'), // Ensure to set a password
        ]);

        $admin->assignRole('admin');
    }
}
