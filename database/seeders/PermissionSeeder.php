<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'access dashboard',

            'impersonate',

            'view users',
            'create users',
            'update users',
            'delete users',

            'view roles',
            'create roles',
            'update roles',
            'delete roles',

            'view permissions',
            'create permissions',
            'update permissions',
            'delete permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::query()->updateOrCreate([
                'name' => $permission,
            ]);
        }

    }
}
