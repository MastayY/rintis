<?php

namespace App\Livewire\Profile;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

use App\Models\User;
use App\Models\Product;
use App\Models\Review;

class Index extends Component
{

    public User $user;
    public string $tab = 'tentang';
    public array $topProducts = [];
    public $userProducts;
    public $userReviews;
    

    public function mount($username)
    {
        $this->user = User::where('username', $username)->firstOrFail();

        // Top 3 products by this user, sorted by average rating
        $this->topProducts = Product::withAvg('reviews', 'rating')
            ->where('user_id', $this->user->id)
            ->orderByDesc('reviews_avg_rating')
            ->take(3)
            ->get()
            ->toArray();

        // All products by this user
        $this->userProducts = Product::with('reviews')
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();

        // All reviews by this user
        $this->userReviews = Review::with(['product'])
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();
    }

    public function switchTab($newTab)
    {
        $this->tab = $newTab;
    }

    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.profile.index');
    }
}
