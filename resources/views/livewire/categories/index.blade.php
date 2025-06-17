<div class="max-w-6xl mx-auto space-y-10 p-4">
    <h1 class="text-4xl font-bold mb-4 text-white text-center">Kategori Produk</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
        @foreach ($categories as $category)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow flex flex-col justify-between h-full">
                <div class="">
                    <a href="{{ route('category.show', $category->slug) }}" wire:navigate class="text-xl font-semibold text-gray-800 hover:text-blue-600">
                        {{ $category->name }}
                    </a>
                    <p class="text-gray-600 mt-2">{{ $category->description }}</p>
                </div>
                <p class="text-sm text-gray-500">({{ $category->products_count }} produk)</p>
            </div>
        @endforeach
    </div>

    <section class="mt-20 md:mt-28">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-white">Produk Teratas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
            @foreach ($category->products as $product)
                <div class="bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 p-6">
                    <div class="flex items-center mb-4">
                        <img src="{{ '/storage/' . $product->image_url }}" alt="{{ $product->title }}" class="w-16 h-16 rounded-lg object-cover mr-4">
                        <div>
                            <h3 class="font-bold text-lg text-white">{{ $product->title }}</h3>
                            <p class="text-sm text-white">{{ Str::limit($product->description, 50) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="flex text-yellow-300">
                            @for ($i = 0; $i < round($product->reviews_avg_rating); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <span class="text-white">{{ number_format($product->reviews_avg_rating, 1) }}/5</span>
                        <span class="text-white">({{ $product->reviews_count }} ulasan)</span>
                    </div>
                    <button class="w-full bg-white/20 py-2 rounded-lg hover:bg-white/30 transition text-white">
                        <a href="{{ route('products.detail', $product->slug) }}">Lihat Detail</a>
                    </button>
                </div>
            @endforeach
        </div>
    </section>

    <section class="text-center mt-20 md:mt-28">
        <div class="bg-white/10 backdrop-blur-lg rounded-xl border border-white/20 p-12">
            <h2 class="text-4xl font-bold text-white">Siap Untuk Memulai?</h2>
            <p class="mt-4 text-white/80">Jelajahi rangkain produk lengkap kami dan temukan solusi sempurna untuk kebutuhan Anda.</p>
            <div class="flex justify-center space-x-4 mt-8">
                <a href="{{ route('products.index') }}" wire:navigate class="bg-white text-purple-600 font-semibold px-8 py-3 rounded-lg hover:bg-purple-600 hover:text-white transition-all duration-200 cursor-pointer">
                    Jelajahi Produk
                </a>
            </div>
        </div>
    </section>
    
</div>
