<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\HandlesRedirects;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{
    use HandlesRedirects;
    use LivewireAlert;

    public User $user;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    #[Validate(['required', 'string', 'email', 'max:255'])]
    public string $email = '';

    #[Validate('required|string|max:2')]
    public string $locale = 'en';

    /** @var array <int,string> */
    public array $userRoles = [];

    public function mount(User $user): void
    {
        $this->authorize('update users');

        $this->user = $user;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->locale = $this->user->locale ?? 'en';

        // get user roles
        $this->userRoles = $this->user->roles->pluck('id')->toArray();
    }

    public function updateUser(): void
    {
        $this->authorize('update users');

        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Convert the userRoles to integers
        $userRoles = Arr::map($this->userRoles, fn ($role): int => (int) $role);

        // Sync the user roles
        $this->user->syncRoles($userRoles);

        $this->flash('success', __('users.user_updated'));

        $this->redirect(route('admin.users.index'), true);

    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.users.edit-user', [
            'roles' => Role::all(),
            'locales' => [
                'en' => 'English',
                'da' => 'Danish',
            ],
        ]);
    }
}
