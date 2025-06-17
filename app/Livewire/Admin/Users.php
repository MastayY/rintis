<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'userDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['name', 'email'];

    #[Url]
    public string $search = '';

    public ?string $role = null;

    public function mount(): void
    {
        $this->authorize('view users');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteUser(string $userId): void
    {

        $this->authorize('delete users');

        $user = User::query()->where('id', $userId)->firstOrFail();

        $user->delete();

        $this->alert('success', __('users.user_deleted'));

        $this->dispatch('userDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.users', [
            'users' => User::query()
                ->with('roles')
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
                ->when($this->role, fn ($query) => $query->role($this->role))
                ->paginate($this->perPage),
            'roles' => Role::all(),
        ]);
    }
}
