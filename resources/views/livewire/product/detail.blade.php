<section class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 flex flex-col space-y-8">
            <div class="bg-white rounded-xl p-6 shadow-lg text-gray-800">
                <div class="flex items-center space-x-8 mb-4">
                    <div>
                        <img
                        src="{{ '/storage/' . $product->image_url }}"
                        alt="Notion AI Logo"
                        class="w-16 h-16 rounded-lg flex-shrink-0"
                        />
                    </div>
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900">
                        {{ $product->title }} - {{ $product->tagline ?? 'No Tagline' }}
                        </h2>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-6">
                    {{ $product->description }}
                </p>
                <img
                src="{{ '/storage/' . $product->images[0]->image_url }}"
                alt="{{ $product->title }} Image"
                class="w-full h-96 rounded-lg object-cover mb-6"
                />
            </div>

            <div class="flex justify-center mb-8">
                <div class="inline-flex bg-white/20 p-3 rounded-lg space-x-5">
                <button
                    onclick="showSection('overview')"
                    class="tab-btn bg-white text-purple-700 font-semibold px-4 py-1.5 rounded-md text-sm"
                    data-tab="overview"
                >
                    Overview
                </button>
                {{-- <button
                    onclick="showSection('teams')"
                    class="tab-btn text-white font-semibold px-4 py-1.5 rounded-md text-sm hover:bg-white/10"
                    data-tab="teams"
                >
                    Teams
                </button> --}}
                </div>
            </div>

            <div id="overview" class="tab-content">
                <div class="bg-white rounded-xl p-8 shadow-lg">
                    <div class="relative w-full">
                        <div class="relative">
                            <div class="overflow-x-auto hide-scrollbar">
                                <div class="flex gap-4 transition-transform duration-300">
                                @foreach ($product->images as $img)
                                    <div class="flex-none">
                                        <div class="bg-purple-50">
                                            <img
                                                src="{{ '/storage/' .  $img->image_url }}"
                                                alt="{{ $product->title }} Gallery Image"
                                                class="w-full h-64 aspect-video object-contain rounded-xl"
                                            />
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @livewire('product.review-section', ['product' => $product])
        </div>
        <div>
        </div>
    </div>
    <aside class="lg:col-span-1 bg-white rounded-xl p-6 h-fit flex flex-col space-y-8 shadow-2xl">
        <div>
            <h3 class="font-bold text-lg mb-3 text-gray-800">
            Informasi Produk
            </h3>
            <div class="space-y-3">
            {{-- <button
                class="w-full bg-red-500 hover:bg-red-600 transition-colors text-white font-bold py-3 rounded-lg flex items-center justify-center space-x-2"
            >
                <i class="fas fa-arrow-up"></i>
                <span>1097 Upvoted</span>
            </button> --}}
            <button
                class="w-full bg-blue-500 hover:bg-blue-600 transition-colors text-white font-bold py-3 rounded-lg flex items-center justify-center space-x-2"
            >
                <i class="fas fa-comment"></i>
                <span>{{ $product->reviews_count }} Ulasan</span>
            </button>
            </div>
        </div>
        <div>
            <h3 class="font-bold text-lg mb-3 text-gray-800">Kategori</h3>
            <div class="flex flex-col items-start gap-3">
            @foreach ($product->categories as $category)
                <a
                href="{{ route('category.show', $category->slug) }}"
                class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-semibold hover:bg-purple-200 transition-colors"
                >
                #{{ $category->name }}
                </a>
            @endforeach
            {{-- <button
                class="bg-purple-600 text-white transition-colors text-sm font-semibold py-2 px-4 rounded-lg inline-flex items-center space-x-2"
            >
                <i class="fas fa-fire"></i>
                <span>1000+ Highly Engaged</span>
            </button> --}}
            </div>
        </div>
        <div>
            <h3 class="font-bold text-lg mb-3 text-gray-800">Detail</h3>
            <div class="space-y-3 text-sm">
            <a
                href="{{ $product->website_url }}"
                target="_blank"
                class="flex items-center space-x-3 text-gray-700 hover:text-blue-600"
            >
                <i class="fas fa-globe w-5 text-center"></i>
                <span>{{ $product->website_url }}</span>
            </a>
            <div class="flex items-center space-x-3 text-gray-500">
                <i class="fas fa-rocket w-5 text-center"></i>
                <span>Launched in {{ $product->created_at->format('Y') }}</span>
            </div>
            {{-- <a
                href="#"
                class="flex items-center space-x-3 text-gray-700 hover:text-blue-600"
            >
                <i class="fas fa-share-alt w-5 text-center"></i>
                <span>Share</span>
            </a> --}}
            </div>
        </div>
    </aside>
</section>
