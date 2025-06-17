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
        // User::factory(10)->create();
        // Create user with specific attributes
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'example@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'locale' => 'en',
            'avatar' => 'https://i.pravatar.cc/300',
            'about' => 'This is a sample user.',
            'phone' => '1234567890',
            'address' => '123 Main St, Anytown, USA',
            'role' => 'Software Engineer',
        ]);

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
