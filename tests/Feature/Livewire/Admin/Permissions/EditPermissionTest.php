<?php

use App\Livewire\Admin\Permissions\EditPermission;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(EditPermission::class)
        ->assertStatus(200);
})->todo();
