<?php

use App\Livewire\Admin\Users\CreateUser;
use App\Models\User;
use Livewire\Livewire;

it('authorizes the component', function (): void {

    Livewire::test(CreateUser::class)
        ->assertForbidden();

    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CreateUser::class)
        ->assertForbidden();

    $user->givePermissionTo('create users');

    Livewire::actingAs($user)
        ->test(CreateUser::class)
        ->assertOk();
});
