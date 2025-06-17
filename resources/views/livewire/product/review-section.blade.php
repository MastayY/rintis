<div x-data="{ open: @entangle('openModal') }">
    <div
        class="bg-white/40 rounded-xl mt-6 p-6 shadow-lg text-gray-800"
    >
        <h3 class="text-2xl font-bold mb-4 text-white px-4">
        Semua Ulasan Produk
        </h3>
        <div
            class="flex flex-col md:flex-row justify-between items-start gap-12 px-4"
        >
            <div class="flex flex-col items-start space-y-4">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-5xl font-bold text-white">{{ $averageRating }}/5</span>
                    <div class="flex text-yellow-300 text-2xl mt-1">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fas {{ $i < round($reviews->avg('rating')) ? 'fa-star' : 'fa-star text-white' }}"></i>
                        @endfor
                    </div>
                </div>
                <p class="text-white/80 text-sm">Berdasarkan {{ $reviews->count() }} ulasan</p>
                @auth
                    {{-- if user already reviewed button will change to reviewed --}}
                    @if ($reviews->where('user_id', auth()->id())->count() > 0)
                        <button
                            class="mt-6 bg-gray-500 text-white px-6 py-2 rounded-lg font-medium cursor-not-allowed"
                            disabled>Diulas</button>
                    @else
                        <button
                            wire:click="togglePopup"
                            class="mt-6 bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors cursor-pointer"
                        >Ulas Sekarang</button>
                        
                    @endif
                @endauth
            </div>

            <div class="flex-1 w-full space-y-4 px-4">
                @foreach (range(5, 1) as $star)
                    <div class="flex items-center gap-2">
                        <div class="flex text-yellow-300">
                            @for ($i = 0; $i < $star; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <div class="flex-1 bg-white/20 rounded-full h-2">
                            <div class="bg-white rounded-full h-2 w-[{{ rand(5,100) }}%]"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="review" class="bg-white/40 rounded-xl mt-6 p-6 shadow-lg text-gray-800">
        <div class="space-y-4">
            @foreach ($reviews as $r)
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr($r->user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-1">
                            <span class="font-semibold text-gray-900">{{ $r->user->name }}</span>
                            <span class="text-sm text-gray-500">{{ $r->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex text-yellow-400 mb-2">
                            @for ($i = 0; $i < $r->rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <p class="text-gray-600 text-sm mb-3">{{ $r->body }}</p>

                        {{-- mark unmark helpful --}}
                        @auth
                            @if (auth()->check() && $r->helpfuls->contains('user_id', auth()->id()))
                                <button wire:click="unmarkHelpful({{ $r->id }})" class="text-sm text-blue-500 cursor-pointer">
                                    <i class="fas fa-thumbs-up"></i> ({{ $r->helpfuls_count }})
                                </button>
                            @else
                                <button wire:click="markHelpful({{ $r->id }})" class="text-sm text-gray-500 cursor-pointer">
                                    <i class="fas fa-thumbs-up"></i> ({{ $r->helpfuls_count }})
                                </button>
                            @endif

                            @if (auth()->check() && auth()->id() === $r->user_id)
                                <button wire:click="deleteReview({{ $r->id }})" class="text-sm text-red-600 hover:underline ml-5">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Popup Modal -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black/30 p-4 z-50" style="display: none;">
        <div @click.away="open = false" class="relative bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">
            <h2 class="text-xl font-bold text-center text-gray-800 mb-2">How would you rate this product?</h2>
            <p class="text-sm text-gray-600 text-center mb-6">Your feedback helps improve this product.</p>

            @error('rating')
                <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
            @enderror
            @error('body')
                <div class="text-red-500 text-sm mb-2">{{ $message }}</div>
            @enderror

            <div>
                <!-- Rating Star Selection -->
                <div class="flex justify-center gap-2 mb-4">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button" wire:click="$set('rating', {{ $i }})" class="text-yellow-400 text-2xl hover:text-yellow-500 transition">
                            <i class="fas {{ $rating >= $i ? 'fa-star' : 'fa-star text-gray-300' }}"></i>
                        </button>
                    @endfor
                </div>

                <textarea wire:model.defer="body"
                    class="w-full h-24 p-3 border border-gray-200 rounded-lg resize-none focus:outline-none focus:ring-2 text-black focus:ring-blue-500 text-sm mb-4"
                    placeholder="Write your review here..."></textarea>

                <button
                    wire:click="submitReview"
                    class="w-full py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-medium rounded-lg hover:from-blue-600 hover:to-purple-600 transition-all"
                    wire:loading.attr="disabled">
                    
                    <span wire:loading wire:target="submitReview" class="flex items-center justify-center">
                        <svg class="animate-spin h-5 w-5 mr-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2.93 6.343A8.001 8.001 0 014 12H0c0 5.523 4.477 10 10 10v-4a6.002 6.002 0 01-3.07-1.657z">
                            </path>
                        </svg>
                        <span class="text-sm">
                            Submitting...
                        </span>
                    </span>

                    <span wire:loading.remove wire:target="submitReview">
                        Submit Review
                    </span>
                </button>
                <button type="button" @click="open = false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                    <i class="fas fa-times"></i>
                </button>
            </form>
        </div>
    </div>
</div>
