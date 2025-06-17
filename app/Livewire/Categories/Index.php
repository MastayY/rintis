<?php

namespace App\Livewire\Categories;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

use App\Models\Category;

class Index extends Component
{

    public function mount(): void
    {
        //
    }

    #[Layout('components.layouts.app')]
    public function render(): View
    {
        // Mengambil semua kategori dengan produk terkait dengan menyertakan jumlah produk setiap kategori dan disimapan ke products_count
        // Mengambil 5 product teratas dari seluruh kategori
        $categories = Category::with(['products' => function ($query) {
            $query->take(5) // Mengambil 5 produk teratas per kategori
                ->withAvg('reviews', 'rating') // Menghitung rata-rata rating produk
                ->withCount('reviews'); // Menghitung jumlah review per produk
        }])
        ->withCount('products') // Menghitung jumlah produk per kategori
        ->get();

        return view('livewire.categories.index', compact('categories'));
    }
}
