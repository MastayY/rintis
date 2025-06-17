<?php

use App\Livewire\Admin\Roles;
use App\Models\User;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\assertDatabaseCount;

it('authorizes the component', function (): void {
    Livewire::test(Roles::class)
        ->assertForbidden();

    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Roles::class)
        ->assertForbidden();

    $user->givePermissionTo('view roles');

    Livewire::actingAs($user)
        ->test(Roles::class)
        ->assertOk();
});

it('requires permission to view delete-button and to delete user', function (): void {

    $user = User::factory()->create();
    $user->givePermissionTo('view roles');

    $role = Role::create(['name' => 'test role']);

    Livewire::actingAs($user)
        ->test(Roles::class)
        ->assertOk()
        ->assertDontSeeHtml('deleteRole(\''.$role->id.'\')');

    $user->givePermissionTo('delete roles');

    Livewire::actingAs($user->fresh())
        ->test(Roles::class)
        ->assertOk()
        ->assertSeeHtml(__('global.delete'))
        ->assertSeeHtml('deleteRole(\''.$role->id.'\')');

    assertDatabaseCount('roles', 2);

    Livewire::actingAs($user->fresh())
        ->test(Roles::class)
        ->assertOk()
        ->assertSeeHtml($role->name)
        ->call('deleteRole', $role->id)
        ->assertDispatched('roleDeleted')
        ->assertHasNoErrors()
        ->assertDontSeeHtml($role->name);

    assertDatabaseCount('roles', 1);

});
