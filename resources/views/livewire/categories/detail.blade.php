<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-white text-center mb-8">
    {{ $category->name }} Products
    </h1>

    <div class="flex justify-center mb-8">
        <div class="inline-flex bg-white/20 p-3 rounded-lg space-x-5">
            <button wire:click="$set('sortBy', 'rating')"
                class="cursor-pointer px-4 py-1.5 rounded-md text-sm font-semibold transition
                {{ $sortBy === 'rating' ? 'bg-white text-purple-700' : 'text-white hover:bg-white/10' }}">
                Highest Rating
            </button>
            <button wire:click="$set('sortBy', 'recent')"
                class="cursor-pointer px-4 py-1.5 rounded-md text-sm font-semibold transition
                {{ $sortBy === 'recent' ? 'bg-white text-purple-700' : 'text-white hover:bg-white/10' }}">
                Recent Launches
            </button>
            <button wire:click="$set('sortBy', 'reviewed')"
                class="cursor-pointer px-4 py-1.5 rounded-md text-sm font-semibold transition
                {{ $sortBy === 'reviewed' ? 'bg-white text-purple-700' : 'text-white hover:bg-white/10' }}">
                Top Reviewed
            </button>
        </div>
    </div>


    <div wire:loading.class="opacity-50 pointer-events-none" class="flex gap-8">
        <div class="flex-1">
            <div class="space-y-4">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center">
                            <img src="{{ '/storage/' . $product->image_url }}" alt="{{ $product->title }}" class="w-12 h-12 rounded-full object-cover">
                        </div>
                        <div class="flex-1">
                            <a href="{{ route('products.detail', $product->slug) }}" class="font-bold text-gray-900 mb-1">
                                {{ $product->title }}
                            </a>
                            <p class="text-gray-600 text-sm mb-3">
                                {{ Str::limit($product->description, 100) }}
                            </p>
                            <div class="flex space-x-2">
                                @foreach ($product->categories as $category)
                                <span
                                    class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs"
                                >#{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 text-sm mt-2">
                            <div class="flex items-center text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= round($product->reviews_avg_rating) ? '' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                            <span class="text-gray-600">{{ number_format($product->reviews_avg_rating, 1) }}/5</span>
                            <span class="text-gray-500">({{ $product->reviews_count }} reviews)</span>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($products->hasMorePages())
            <div class="text-center mt-8">
                <button
                wire:click="loadMore"
                class="bg-white text-purple-600 font-semibold px-8 py-3 rounded-lg hover:bg-purple-600 hover:text-white transition-all duration-200"
                >
                Load More Products
                </button>
            </div>
            @endif
        </div>
    </div>
</div>
