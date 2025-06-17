<?php

namespace App\Livewire\Product;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class CreateProduct extends Component
{
    use WithFileUploads;

    public string $title = '';
    public string $tagline = '';
    public string $description = '';
    public string $website_url = '';
    public $image;
    public array $gallery = [];
    public string $selectedCategory = '';
    public array $selectedCategories = [];

    public function submit()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'description' => 'required',
            'website_url' => 'required|url',
            'image' => 'required|image|max:2048',
            'gallery.*' => 'image|max:2048',
            'selectedCategory' => 'required',
        ]);

        // append selectedCategory to selectedCategories
        array_push($this->selectedCategories, $this->selectedCategory);

        $user = auth()->user();

        $product = Product::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'title' => $this->title,
            'tagline' => $this->tagline,
            'description' => $this->description,
            'website_url' => $this->website_url,
            'image_url' => $this->image->storePublicly('products_image', 'public'),
        ]);

        foreach ($this->selectedCategories as $catId) {
            ProductCategory::create([
                'id' => Str::uuid(),
                'product_id' => $product->id,
                'category_id' => $catId,
            ]);
        }

        foreach ($this->gallery as $img) {
            ProductImage::create([
                'id' => Str::uuid(),
                'product_id' => $product->id,
                'image_url' => $img->storePublicly('products_gallery', 'public'),
            ]);
        }

        session()->flash('message', 'Produk berhasil diluncurkan!');
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.product.create-product', [
            'categories' => Category::all(),
        ]);
    }
}
