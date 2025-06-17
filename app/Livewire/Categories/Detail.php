<?php

namespace App\Livewire\Categories;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;

class Detail extends Component
{

    use WithPagination;

    public $categorySlug;
    public $perPage = 10;
    public $loadMoreCount = 10;
    public $category;
    public $sortBy = 'rating';

    protected $updatesQueryString = ['page'];

    public function mount($slug)
    {
        $this->categorySlug = $slug;
        $this->category = Category::where('slug', $slug)->firstOrFail();

    }

    public function loadMore()
    {
        $this->perPage += $this->loadMoreCount;
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $products = $this->category->products()->with(['categories', 'user'])
        ->withAvg('reviews', 'rating')
        ->withCount('reviews')
        ->when($this->sortBy === 'rating', function ($query) {
            $query->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating');
        })
        ->when($this->sortBy === 'recent', function ($query) {
            $query->orderByDesc('created_at');
        })
        ->when($this->sortBy === 'reviewed', function ($query) {
            $query->withCount('reviews')->orderByDesc('reviews_count');
        })
        ->paginate($this->perPage);

        return view('livewire.categories.detail', [
            'products' => $products,
            'category' => $this->category
        ]);
    }
}
