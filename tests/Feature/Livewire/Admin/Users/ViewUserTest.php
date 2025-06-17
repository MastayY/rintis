<?php

use App\Livewire\Admin\Users\ViewUser;
use App\Models\User;
use Livewire\Livewire;

it('authorizes the component', function (): void {

    $user = User::factory()->create();

    Livewire::test(ViewUser::class, ['user' => $user])
        ->assertForbidden();

    Livewire::actingAs($user)
        ->test(ViewUser::class, ['user' => $user])
        ->assertForbidden();

    $user->givePermissionTo('view users');

    Livewire::actingAs($user)
        ->test(ViewUser::class, ['user' => $user])
        ->assertOk();
});
