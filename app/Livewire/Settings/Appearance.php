<?php

namespace App\Livewire\Settings;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Appearance extends Component
{
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.settings.appearance');
    }
}
