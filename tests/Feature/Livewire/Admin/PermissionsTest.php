<?php

use App\Livewire\Admin\Permissions;
use App\Models\User;
use Livewire\Livewire;

it('authorizes the component', function (): void {

    Livewire::test(Permissions::class)
        ->assertForbidden();

    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Permissions::class)
        ->assertForbidden();

    $user->givePermissionTo('view permissions');

    Livewire::actingAs($user)
        ->test(Permissions::class)
        ->assertOk();
});
