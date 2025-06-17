<div class="max-w-4xl mx-auto px-6 py-12">
    <!-- Profile Header -->
    <div class="text-center mb-8">
        <div class="w-24 h-24 bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-white font-bold text-3xl">{{ $user->initials() }}</span>
        </div>
        <h1 class="text-4xl font-bold text-white mb-2">{{ $user->name }}</h1>
        <p class="text-base text-gray-300 mb-2">{{ $user->role }}</p>
        <div class="flex flex-col items-center justify-center space-y-2 text-white/80 text-sm mb-4">
            <span class="bg-yellow-400 text-yellow-900 text-xs px-3 py-1 rounded-full">@ {{ $user->username }}</span>
            <span class="bg-green-400 text-green-900 text-xs px-3 py-1 rounded-full">Member dari {{ $user->created_at->format('F Y') }}</span>
        </div>
        @if(auth()->check() && auth()->id() === $user->id)
            <a href="/settings/profile" wire:navigate class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-2 rounded-full transition-colors">
                Edit my profile
            </a>
        @endif
    </div>

    <!-- Navigation Tabs -->
    <div class="flex justify-center mb-8">
        <div class="flex bg-white/20 backdrop-blur-sm rounded-full p-1">
            @foreach (['tentang', 'ulasan', 'produk'] as $item)
                <button
                    wire:click="switchTab('{{ $item }}')"
                    class="px-6 py-2 rounded-full font-semibold transition-all cursor-pointer {{ $tab === $item ? 'bg-white text-purple-600' : 'text-white/80 hover:text-white' }}">
                    {{ ucfirst($item) }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Content Container -->
    <div class="space-y-8">
        @if($tab === 'tentang')
            <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6">
                <h2 class="text-lg md:text-xl font-bold text-white mb-4">Tentang</h2>
                <p class="text-white/90 leading-relaxed text-sm md:text-base">
                    {{ $user->about ?? 'Pengguna ini belum mengisi tentang dirinya.' }}
                </p>

                <h2 class="text-lg md:text-xl font-bold text-white mt-4 mb-2">Branding</h2>
                <p class="text-white/90 leading-relaxed text-sm md:text-base">
                    {{ $user->role ?? 'Pengguna ini belum mengisi branding.' }}
                </p>
            </div>

            <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6">
                <h2 class="text-xl font-bold text-white mb-4">Kontak</h2>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-envelope w-5 text-pink-400"></i>
                        <span class="text-sm text-white">{{ $user->email ?? 'Pengguna ini belum mengisi email.' }}</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-phone w-5 text-pink-400"></i>
                        <span class="text-sm text-white">
                            {{ $user->phone ?? 'Pengguna ini belum mengisi nomor telepon.' }}
                        </span>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-map-marker-alt w-5 text-pink-400"></i>
                        <span class="text-sm text-white">
                            {{ $user->address ?? 'Pengguna ini belum mengisi alamat.' }}
                        </span>
                    </div>
                </div>
            </div>

        @elseif($tab === 'ulasan')
            <div class="bg-white backdrop-blur-sm rounded-2xl p-6 text-white">
                <h2 class="text-xl font-bold mb-6">Semua Ulasan dari {{ $user->name }}</h2>
                @forelse($userReviews as $review)
                    <div class="bg-white/30 backdrop-blur-sm rounded-xl p-4 mb-4 text-gray-900">
                        <a href="{{ route('products.detail', $review->product->slug) }}" class="font-semibold text-blue-700">{{ $review->product->title ?? '-' }}</a>
                        <p class="text-sm text-gray-700 mt-1">{{ $review->body }}</p>
                        <div class="text-yellow-500 mt-1 text-sm">
                            ⭐ {{ $review->rating }}/5
                        </div>
                        <div class="text-gray-500 text-xs mt-1">{{ $review->created_at->diffForHumans() }}</div>
                    </div>
                @empty
                    <p class="text-white/80">Belum ada ulasan dari pengguna ini.</p>
                @endforelse
            </div>
        @elseif($tab === 'produk')
            <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 text-white">
                <h2 class="text-xl font-bold mb-6">Top 3 Produk Unggulan</h2>
                <div class="grid md:grid-cols-3 gap-4">
                    @foreach($topProducts as $product)
                        <div class="bg-white/30 p-4 rounded-xl shadow-md text-gray-900">
                            <h3 class="font-bold text-lg">{{ $product['title'] }}</h3>
                            <p class="text-sm text-gray-700">{{ Str::limit($product['description'], 80) }}</p>
                            <div class="mt-2 text-yellow-500 text-sm">
                                ⭐ {{ number_format($product['reviews_avg_rating'], 1) }}/5
                            </div>
                        </div>
                    @endforeach
                </div>

                <h2 class="text-xl font-bold my-6">Semua Produk</h2>
                @foreach($userProducts as $product)
                    <div class="bg-white/30 p-4 rounded-xl shadow mb-3">
                        <a href="{{ route('products.detail', $product->slug) }}" class="text-lg font-semibold text-purple-700">{{ $product->title }}</a>
                        <p class="text-sm text-gray-700">{{ Str::limit($product->description, 100) }}</p>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $product->created_at->format('d M Y') }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
