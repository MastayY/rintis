<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class Home extends Component
{
    use WithPagination;

    public $time = 'today';
    public $categorySlug = 'all'; // default
    public $products; // Store loaded products
    private $pagination; // store paginated result
    public $page = 1;

    protected $queryString = ['time', 'categorySlug' => 'category', 'page'];

    public function updatedTime()
    {
        $this->resetPage();
        $this->products = collect();
        $this->loadProducts(true);
    }

    public function updatedCategorySlug()
    {
        $this->resetPage();
        $this->products = collect();
        $this->loadProducts(true);
    }

    public function loadMore() {
        $this->page++;
        $this->loadProducts(); // Load more products
    }

    public function mount(): void
    {
        $this->products = collect(); // supaya bisa ->merge()
        $this->loadProducts();
    }

    public function loadProducts($reset = false)
    {
        $this->pagination = Product::with(['user', 'categories', 'images'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->when($this->time !== 'all', fn($q) => match($this->time) {
                'today' => $q->whereDate('created_at', today()),
                'week' => $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]),
                'month' => $q->whereMonth('created_at', now()->month),
                default => $q
            })
            ->when($this->categorySlug !== 'all', fn($q) =>
                $q->whereHas('categories', fn($q2) => $q2->where('slug', $this->categorySlug))
            )
            ->orderByDesc('created_at') // Sort by latest
            ->paginate(6, ['*'], 'page', $this->page);

        $collection = $this->pagination->getCollection();

        // Ganti data kalau reset, merge kalau loadMore
        $this->products = $reset
            ? $collection
            : $this->products->merge($collection);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $categories = Category::withCount('products')->orderByDesc('products_count')->get();

        return view('livewire.home', [
            'products' => $this->products,
            'categories' => $categories,
            'hasMorePages' => $this->pagination?->hasMorePages() ?? false,
            'activeCategory' => $this->categorySlug !== 'all'
                ? Category::where('slug', $this->categorySlug)->first()
                : null,
        ]);
    }
}
