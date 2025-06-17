<?php

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'roleDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['name'];

    #[Url]
    public string $search = '';

    public function mount(): void
    {
        $this->authorize('view roles');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteRole(string $roleId): void
    {
        $this->authorize('delete roles');

        $role = Role::query()->where('id', $roleId)->firstOrFail();

        $role->delete();

        $this->alert('success', __('roles.role_deleted'));

        $this->dispatch('roleDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.roles', [
            'roles' => Role::query()
                ->with('permissions')
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
                ->paginate($this->perPage),
        ]);
    }
}
