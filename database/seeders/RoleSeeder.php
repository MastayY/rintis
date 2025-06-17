<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::query()->updateOrCreate(['name' => 'Super Admin']);
        $permissions = Permission::all()->pluck('name')->toArray();
        $role->givePermissionTo($permissions);

    }
}
