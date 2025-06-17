<?php

namespace App\Livewire\Product;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Product;
use App\Models\Review;

class Detail extends Component
{
    public Product $product;

    public function mount(): void
    {
        $this->product = Product::with(['categories', 'user', 'images'])
            ->withCount('reviews') // ⬅️ jumlah review
            ->withAvg('reviews', 'rating') // ⬅️ rata-rata rating
            ->where('slug', request()->route('slug'))
            ->firstOrFail();
    }

    public function render(): View
    {
        return view('livewire.product.detail');
    }
}
