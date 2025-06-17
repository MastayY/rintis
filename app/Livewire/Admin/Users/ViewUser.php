<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewUser extends Component
{
    public User $user;

    public function mount(User $user): void
    {
        $this->authorize('view users');

        $this->user = $user;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.users.view-user');
    }
}
