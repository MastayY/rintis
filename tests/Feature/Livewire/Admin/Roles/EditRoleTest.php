<?php

use App\Livewire\Admin\Roles\EditRole;
use App\Models\User;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;

it('authorizes the component', function (): void {

    $role = Role::create(['name' => 'test']);

    Livewire::test(EditRole::class, ['role' => $role])
        ->assertForbidden();

    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EditRole::class, ['role' => $role])
        ->assertForbidden();

    $user->givePermissionTo('update roles');

    Livewire::actingAs($user)
        ->test(EditRole::class, ['role' => $role])
        ->assertOk();
});
