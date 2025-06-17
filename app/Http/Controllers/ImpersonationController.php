<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    use AuthorizesRequests;

    public function store(User $user): RedirectResponse
    {
        $this->authorize('impersonate');

        // Store the current user ID in the session
        session(['admin_user_id' => Auth::id()]);

        // Log in as the target user
        Auth::loginUsingId($user->id);

        return redirect()->route('dashboard');

    }

    public function destroy(): RedirectResponse
    {
        // Get the previous user ID from the session
        $previousUserId = session('admin_user_id');

        // Log back in as the previous user
        Auth::loginUsingId($previousUserId);

        // Remove the previous user ID from the session
        session()->forget('admin_user_id');

        return redirect(route('admin.index'));
    }
}
