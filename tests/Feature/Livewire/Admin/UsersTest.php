<?php

use App\Livewire\Admin\Users;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;

it('authorizes the component', function (): void {
    Livewire::test(Users::class)
        ->assertForbidden();

    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Users::class)
        ->assertForbidden();

    $user->givePermissionTo('view users');

    Livewire::actingAs($user)
        ->test(Users::class)
        ->assertOk();
});

it('requires permission to view delete-button and to delete user', function (): void {

    $user = User::factory()->create();
    $user->givePermissionTo('view users');

    Livewire::actingAs($user)
        ->test(Users::class)
        ->assertOk()
        ->assertDontSeeHtml('deleteUser(\''.$user->id.'\')');

    $user->givePermissionTo('delete users');

    Livewire::actingAs($user->fresh())
        ->test(Users::class)
        ->assertOk()
        ->assertSeeHtml(__('global.delete'))
        ->assertSeeHtml('deleteUser(\''.$user->id.'\')');

    $userToBeDeleted = User::factory()->create();

    assertDatabaseCount('users', 2);

    Livewire::actingAs($user->fresh())
        ->test(Users::class)
        ->assertOk()
        ->assertSeeHtml($userToBeDeleted->email)
        ->call('deleteUser', $userToBeDeleted->id)
        ->assertDispatched('userDeleted')
        ->assertHasNoErrors()
        ->assertDontSeeHtml($userToBeDeleted->email);

    assertDatabaseCount('users', 1);

});
