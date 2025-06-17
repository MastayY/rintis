<?php

use App\Livewire\Admin\Permissions\CreatePermission;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(CreatePermission::class)
        ->assertStatus(200);
});
