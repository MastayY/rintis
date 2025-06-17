<div class="">
    <div class="text-center py-16 px-6">
      <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Selamat Datang di Rintis 🌱</h1>
      <p class="text-xl text-white/80 max-w-2xl mx-auto">Dimana kamu bisa menemukan berbagai produk digital dari para kreator lokal Indonesia. Temukan produk yang kamu butuhkan, dukung kreator lokal, dan tingkatkan produktivitasmu!</p>
    </div>
    
    <div class="flex justify-center mb-12" wire:key="tabs">
      <div class="flex bg-white/20 backdrop-blur-sm rounded-full p-1">
        @foreach(['today'=>'Today','week'=>'This Week','month'=>'This Month','all'=>'All Time'] as $key=>$label)
          <button wire:click="$set('time','{{ $key }}')" 
                  class="px-4 md:px-6 py-2 text-xs md:text-base font-semibold rounded-full transition cursor-pointer
                         {{ $time==$key ? 'bg-white text-purple-600' : 'text-white/80 hover:text-white' }}">
            {{ $label }}
          </button>
        @endforeach
      </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-6 pb-16 flex gap-8">
      <div class="flex-1">
        <div class="grid md:grid-cols-2 gap-8">
          @foreach($products as $product)
            <div class="bg-white rounded-2xl p-6 card-hover">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        {{-- product image url --}}
                        <img src="{{ '/storage/' . $product->image_url }}" alt="{{ $product->title }}" class="w-16 h-16 rounded-full object-cover">
                        {{-- product title and description --}}
                        <div>
                            <a href="{{ route('products.detail', $product->slug) }}" wire:navigate class="text-xl font-bold text-gray-900">{{ $product->title }}</a>
                            <p class="text-gray-600 text-sm mt-2">
                                {{ Str::limit($product->description, 120) }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    @foreach ($product->categories as $category)
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full">
                            # {{ $category->name }}
                        </span>
                    @endforeach
                    <div class="flex items-center space-x-4">
                        {{-- tahun --}}
                        <span>{{ $product->created_at->format('Y') }}</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between">
                    {{-- rating that get from withAvg('rating') --}}
                    <div class="flex items-center text-yellow-500 text-xs">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fas fa-star {{ $i < number_format($product->reviews_avg_rating, 1) ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                        @endfor
                        <span class="ml-2">{{ number_format($product->reviews_avg_rating, 1) }} / 5</span>
                    </div>
                    <div class="flex items-center text-gray-500 text-sm">
                        <i class="fas fa-comment mr-1"></i>
                        <span>{{ $product->reviews_count }} Ulasan</span>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
    
        @if($hasMorePages)
          <div class="text-center mt-12">
            <button wire:click="loadMore" 
                    wire:loading.attr="disabled"
                    class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-8 py-3 rounded-full font-semibold transition">
              <span wire:loading wire:target="loadMore">Loading...</span>
              <span wire:loading.remove wire:target="loadMore">Load More Products</span>
            </button>
          </div>
        @endif
      </div>
    
      {{-- <aside class="lg:w-80 bg-white rounded-2xl p-6 sticky top-6 max-h-screen overflow-auto">
        <h3 class="font-bold mb-4">Categories</h3>
        <button wire:click="$set('categorySlug','all')"
          class="w-full flex justify-between p-3 rounded-lg mb-2 transition cursor-pointer
                {{ $categorySlug === 'all' ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
          <span>All Categories</span>
      </button>

        @foreach($categories as $cat)
          <button wire:click="$set('categorySlug','{{ $cat->slug }}')"
            class="w-full flex justify-between p-3 rounded-lg mb-2 transition cursor-pointer
                  {{ $categorySlug === $cat->slug ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
            <span>{{ $cat->name }}</span>
            <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $cat->products_count }}</span>
          </button>
        @endforeach
      </aside> --}}
    </div>
</div>
