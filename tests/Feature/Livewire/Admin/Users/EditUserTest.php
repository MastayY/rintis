<?php

use App\Livewire\Admin\Users\EditUser;
use App\Models\User;
use Livewire\Livewire;

it('authorizes the component', function (): void {

    $user = User::factory()->create();
    Livewire::test(EditUser::class, ['user' => $user])
        ->assertForbidden();

    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(EditUser::class, ['user' => $user])
        ->assertForbidden();

    $user->givePermissionTo('update users');

    Livewire::actingAs($user)
        ->test(EditUser::class, ['user' => $user])
        ->assertOk();
});
