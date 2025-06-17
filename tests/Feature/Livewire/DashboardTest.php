<?php

use App\Livewire\Dashboard;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(Dashboard::class)
        ->assertStatus(200);
});
