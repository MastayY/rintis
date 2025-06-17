<section>
    <div class="w-full max-w-3xl mx-auto bg-white/100 backdrop-blur-md p-8 mt-5 mb-2 rounded-2xl">
        <h2 class="text-3xl font-bold text-blue-500 text-center py-5">Tambah Produk</h2>
        <form wire:submit.prevent="submit" enctype="multipart/form-data">
            <!-- Step 1: Product Information -->
            <div class="mb-8">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center">
                        <span class="text-white font-bold">1</span>
                    </div>
                    <h2 class="text-xl font-semibold text-blue-500">Informasi Produk</h2>
                </div>
                <div class="space-y-4 mx-4 md:mx-14">
                    <div class="mb-4 input-group">
                        <label for="title" class="block text-sm font-medium text-gray-500 mb-1">Nama Produk</label>
                        <div class="relative">
                            <input type="text" wire:model="title" required autofocus id="title" placeholder="Nama Produk" class="w-full px-4 py-2 bg-white/10 rounded-lg border border-blue-500/80 text-black placeholder-gray/100">
                        </div>
                    </div>
                    <div class="mb-4 input-group">
                        <label for="tagline" class="block text-sm font-medium text-gray-500 mb-1">Tagline Produk</label>
                        <div class="relative">
                            <input type="text" wire:model="tagline" required autofocus id="tagline" placeholder="Tagline Produk" class="w-full px-4 py-2 bg-white/10 rounded-lg border border-blue-500/80 text-black placeholder-gray/100">
                        </div>
                    </div>
                    <div class="mb-4 input-group">
                        <label for="website_url" class="block text-sm font-medium text-gray-500 mb-1">Website Produk</label>
                        <div class="relative">
                            <input type="url" wire:model="website_url" required autofocus id="website_url" placeholder="Website Produk" class="w-full px-4 py-2 bg-white/10 rounded-lg border border-blue-500/80 text-black placeholder-gray/100">
                        </div>
                    </div>
                    <div class="mb-4 input-group">
                        <label for="cat" class="block text-sm font-medium text-gray-500 mb-1">Kategori Produk</label>
                        <div class="flex gap-4">
                            <select wire:model="selectedCategory" class="w-full px-4 py-2 bg-white/10 rounded-lg border border-blue-500/80 text-black">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 input-group">
                        <label for="description" class="block text-sm font-medium text-gray-500 mb-1">Deskripsi Produk</label>
                        <textarea wire:model="description" required id="description" placeholder="Deskripsi Produk" rows="4" class="w-full px-4 py-2 bg-white/10 rounded-lg border border-blue-500/80 text-black placeholder-gray/100"></textarea>
                    </div>
                </div>
            </div>
        
            <!-- Step 2: Media & Assets -->
            <div class="mb-8">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <h2 class="text-xl font-semibold text-blue-500">Media & Assets</h2>
                </div>
                <div class="space-y-4 mx-4 md:mx-14">
                    <label for="product-logo" class="block text-sm font-medium leading-6 text-blue-500">Product Logo *</label>

                    @error('image')
                        <span class="text-danger text-sm py-2"">{{ $message }}</span>
                    @enderror

                    <div wire:loading wire:target="image" wire:key="image">
                        {{-- Loader for gallery --}}
                        <div class="flex items-center justify-center">
                            <flux:icon.loader-circle class="animate-spin size-6 text-gray-500" />
                        </div>
                    </div>
            
                    @if ($image)
                        <div class="flex items-center gap-3 overflow-x-auto">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview Gambar Galeri" class="w-20 h-20 object-cover rounded-full flex-shrink-0">
                        </div>
                    @endif
        
                    <div class="flex items-center justify-center w-full">
                        <label for="product-image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG or JPG  (Max 1 Foto)</p>
                            </div>
                            <input id="product-image" type="file" wire:model="image" accept="image/*" name="image" required class="hidden" />
                        </label>
                    </div> 
    
                    <label for="product-logo" class="block text-sm font-medium leading-6 text-blue-500">Product Gallery *</label>

                    @error('gallery')
                        <span class="text-danger text-sm py-2">{{ $message }}</span>
                    @enderror

                    <div wire:loading wire:target="gallery" wire:key="gallery">
                        {{-- Loader for gallery --}}
                        <div class="flex items-center justify-center">
                            <flux:icon.loader-circle class="animate-spin size-6 text-gray-500" />
                        </div>
                    </div>
            
                    @if ($gallery)
                        <div class="flex items-center gap-3 overflow-x-auto">
                            @foreach ($gallery as $image)
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview Gambar Galeri" class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                            @endforeach
                        </div>
                    @endif

                    <div class="flex items-center justify-center w-full">
                        <label for="product-gallery" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG or JPG (Max 5 Foto)</p>
                            </div>
                            <input id="product-gallery" type="file" wire:model="gallery" accept="image/*" name="gallery[]" required multiple class="hidden" />
                        </label>
                    </div>
                </div>
            </div>
        
            <!-- Submit Button -->
            <div class="relative">
                <button type="submit" class="w-full px-8 py-3 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg text-white font-semibold hover:opacity-90 transition-opacity" wire:loading.attr="disabled">
                    <svg wire:loading wire:target="submit" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                        </path>
                    </svg>
                    <span wire:loading.remove wire:target="submit">🌱 Rintis Sekarang</span>
                </button>
            </div>
        </form>
    </div>
</section>
