<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Profile extends Component
{
    public string $name = '';

    public string $username = '';

    public ?string $avatar = null;
    
    public ?string $about = null;

    public string $email = '';

    public string $role = '';

    public string $phone = '';
    
    public string $address = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->username = Auth::user()->username;
        $this->avatar = Auth::user()->avatar;
        $this->about = Auth::user()->about;
        $this->role = Auth::user()->role ?? '';
        $this->phone = Auth::user()->phone ?? '';
        $this->address = Auth::user()->address ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],

            'username' => [
                'required',
                'string',
                'lowercase',
                'alpha_dash',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],

            'avatar' => ['nullable', 'string', 'max:255'],

            'about' => ['nullable', 'string', 'max:1000'],
            'role' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        session()->flash('status', 'Profil berhasil diperbarui.');

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.settings.profile');
    }
}
