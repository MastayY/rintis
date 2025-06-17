<div class="container mx-auto px-6 py-8">
    <div class="flex space-x-8 border-b border-white/20 mb-8">
        <a href="{{ route('settings.profile') }}" wire:navigate class="py-2 border-b-2 border-white text-white font-bold">My Details</a>
        {{-- <a href="followed_product.html" wire:navigate class="py-2 text-gray-300 hover:text-white">Followed Products</a> --}}
        {{-- <a href="{{ route('settings.appearance') }}" wire:navigate class="py-2 text-gray-300 hover:text-white">Appearance</a> --}}
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        {{-- Left Sidebar --}}
        {{ $slot }}
    </div>
</div>
