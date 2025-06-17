<?php

use App\Livewire\Home;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(Home::class)
        ->assertStatus(200);
});
