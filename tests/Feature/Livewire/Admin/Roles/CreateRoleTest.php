<?php

use App\Livewire\Admin\Roles\CreateRole;
use App\Models\User;
use Livewire\Livewire;

it('authorizes the component', function (): void {

    Livewire::test(CreateRole::class)
        ->assertForbidden();

    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreateRole::class)
        ->assertForbidden();

    $user->givePermissionTo('create roles');

    Livewire::actingAs($user)
        ->test(CreateRole::class)
        ->assertOk();
});
