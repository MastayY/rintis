<?php

namespace App\Livewire\Admin\Roles;

use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRole extends Component
{
    use LivewireAlert;

    public Role $role;

    #[Validate('required|string|max:255')]
    public string $name = '';

    /** @var array<mixed> */
    #[Validate('array|min:1')]
    public array $selectedPermissions = [];

    public function mount(Role $role): void
    {
        $this->authorize('update roles');

        $this->role = $role;

        $this->name = $role->name;

        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();

    }

    public function editRole(): void
    {
        $this->authorize('update roles');

        $this->validate();

        $this->role->update([
            'name' => $this->name,
        ]);

        // convert string to int
        $permissions = collect($this->selectedPermissions)->map(fn ($permission): int => (int) $permission)->toArray();

        $this->role->syncPermissions($permissions);

        $this->flash('success', __('roles.role_updated'));

        $this->redirect(route('admin.roles.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.roles.edit-role', [
            'permissions' => Permission::all(),
        ]);
    }
}
