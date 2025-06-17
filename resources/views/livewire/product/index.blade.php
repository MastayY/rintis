<div x-data="{ openSidebar: false }" class="">
    <div class="text-center py-16 px-6">
      <h1 class="text-3xl md:text-6xl font-bold text-white mb-6">Produk Teratas</h1>
      <p class="text-base md:text-xl text-white/80 max-w-2xl mx-auto">
        Temukan produk terbaik kami yang telah mendapatkan ulasan positif dari pelanggan. 
        Pilih kategori untuk melihat produk unggulan kami.
      </p>
    </div>
    
    <div class="flex justify-center mb-12" wire:key="tabs">
      <div class="flex bg-white/20 backdrop-blur-sm rounded-full p-1">
        @foreach(['today'=>'Today','week'=>'This Week','month'=>'This Month','all'=>'All Time'] as $key=>$label)
          <button wire:click="$set('time','{{ $key }}')" 
                  class="px-4 md:px-6 py-2 text-xs font-semibold rounded-full transition cursor-pointer
                         {{ $time==$key ? 'bg-white text-purple-600' : 'text-white/80 hover:text-white' }}">
            {{ $label }}
          </button>
        @endforeach
      </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-6 pb-16 flex gap-8">
      <div class="flex-1">
        <div class="grid md:grid-cols-2 gap-8">
        <!-- Mobile Filter Button -->
          <div class="md:hidden text-center">
            <button @click="openSidebar = true"
                    class="cursor-pointer bg-white/20 backdrop-blur-sm text-white px-6 py-2 rounded-full font-semibold hover:bg-white/30 transition">
              <i class="fas fa-filter mr-2"></i> Filter
            </button>
          </div>
          @forelse (($products ?? collect()) as $product)
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
                            <i class="fas fa-star {{ $i < round($product->reviews_avg_rating ?? 0) ? 'text-yellow-500' : 'text-gray-300' }}"></i>
                        @endfor

                        <span class="ml-2">
                          {{ number_format($product->reviews_avg_rating ?? 0, 1) }} / 5
                        </span>

                    </div>
                    <div class="flex items-center text-gray-500 text-sm">
                        <i class="fas fa-comment mr-1"></i>
                        <span>{{ $product->reviews_count ?? 0 }} Ulasan</span>
                    </div>
                </div>
            </div>
          @empty
            <div class="col-span-2 text-center">
              <p class="text-lg">Tidak ada produk ditemukan.</p>
              <p class="mt-2">Coba ubah filter atau kategori yang dipilih.</p>
            </div>
          @endforelse
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
    
      <!-- Desktop Sidebar -->
      <aside class="hidden lg:block lg:w-80 bg-white rounded-2xl p-6 sticky top-6 max-h-screen overflow-auto">
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
      </aside>

      <!-- Mobile Sidebar Overlay -->
      <div class="lg:hidden fixed inset-0 bg-black/40 z-40" x-show="openSidebar" x-transition.opacity @click="openSidebar = false" style="display: none;"></div>

      <!-- Mobile Sidebar Panel -->
      <div class="lg:hidden fixed top-0 right-0 w-72 h-full bg-white z-50 shadow-lg transform transition-transform duration-300 ease-in-out"
          x-show="openSidebar"
          x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="translate-x-full"
          x-transition:enter-end="translate-x-0"
          x-transition:leave="transition ease-in duration-200"
          x-transition:leave-start="translate-x-0"
          x-transition:leave-end="translate-x-full"
          @click.away="openSidebar = false"
          style="display: none;">
        
        <div class="p-6 overflow-y-auto h-full">
          <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-lg">Categories</h3>
            <button @click="openSidebar = false" class="text-gray-500 hover:text-gray-700 cursor-pointer">
              <i class="fas fa-times"></i>
            </button>
          </div>

          <button wire:click="$set('categorySlug','all')" @click="openSidebar = false"
            class="w-full flex justify-between p-3 rounded-lg mb-2 transition cursor-pointer
            {{ $categorySlug === 'all' ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
            <span>All Categories</span>
          </button>
          @foreach($categories as $cat)
            <button wire:click="$set('categorySlug','{{ $cat->slug }}')" @click="openSidebar = false"
              class="w-full flex justify-between p-3 rounded-lg mb-2 transition cursor-pointer
              {{ $categorySlug === $cat->slug ? 'bg-gradient-to-r from-blue-500 to-purple-500 text-white' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }}">
              <span>{{ $cat->name }}</span>
              <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $cat->products_count }}</span>
            </button>
          @endforeach
        </div>
      </div>
    </div>
</div>
