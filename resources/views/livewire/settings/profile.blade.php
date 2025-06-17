<section class="w-full">
    <x-settings.layout>
        <div class="lg:col-span-2">
            <h1 class="text-4xl font-bold mb-8 text-white">Profile Details</h1>
            
            <form class="space-y-6" wire:submit="updateProfileInformation">
                <div>
                    <label for="name" class="block text-sm font-medium mb-1 text-white">Nama</label>
                    <input wire:model="name" type="text" id="name" name="name" required autofocus class="form-input w-full rounded-lg px-4 py-3 placeholder-white/80 text-white" value="{{ auth()->user()->name }}" placeholder="cth: Jajang Ban Serep">
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium mb-1 text-white">Username</label>
                    <input wire:model="username" type="text" id="username" name="username" placeholder="cth: asepbensin" class="form-input w-full rounded-lg px-4 py-3 placeholder-white/80 text-white" value="{{ auth()->user()->username }}" required disabled>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium mb-1 text-white">Email</label>
                    <input type="text" id="email" placeholder="example@mail.com" class="form-input w-full rounded-lg px-4 py-3 placeholder-white/80 text-white" value="{{ auth()->user()->email }}" required>

                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                        <div>
                            <flux:text class="mt-4">
                                {{ __('settings.your_email_is_unverified') }}
    
                                <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                    {{ __('settings.click_here_to_request_another') }}
                                </flux:link>
                            </flux:text>
    
                            @if (session('status') === 'verification-link-sent')
                                <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                    {{ __('settings.verification_link_sent') }}
                                </flux:text>
                            @endif
                        </div>
                    @endif
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium mb-1 text-white">Apa Branding Kamu?</label>
                    <input type="text" wire:model="role" id="role" placeholder="cth: Blockchain Developer" class="form-input w-full rounded-lg px-4 py-3 placeholder-white/80 text-white">
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium mb-1 text-white">Alamat</label>
                    <input type="text" wire:model="address" id="address" placeholder="cth: Klaten" class="form-input w-full rounded-lg px-4 py-3 placeholder-white/80 text-white">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium mb-1 text-white">Nomor HP</label>
                    <input type="tel" wire:model="phone" id="phone" placeholder="08xxxx" class="form-input w-full rounded-lg px-4 py-3 placeholder-white/80 text-white">
                </div>
                <div>
                    <label for="about" class="block text-sm font-medium mb-1 text-white">Tentang Kamu</label>
                    <textarea wire:model="about" id="about" rows="5" placeholder="Deskripsikan dirimu" class="form-input w-full rounded-lg px-4 py-3 placeholder-white/80 text-white" value="{{ auth()->user()->about }}" required></textarea>
                </div>
                <div>
                    <div wire:loading.remove wire:target="updateProfileInformation">
                        <button type="submit" class="bg-white/20 hover:bg-white/30 text-white font-semibold py-3 px-8 rounded-lg transition-colors cursor-pointer">
                            Simpan
                        </button>
                    </div>
                    <div wire:loading wire:target="updateProfileInformation" class="text-white font-semibold">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </div>
                    @if (session()->has('status'))
                        <div class="mt-4 text-green-500 font-semibold">
                            Berhasil memperbarui profil!
                        </div>
                    @endif
                </div>
            </form>
        </div>

        <div class="hidden md:flex flex-col items-center lg:items-start lg:pt-20">
            <div class="w-32 h-32 bg-teal-700 rounded-full flex items-center justify-center ring-4 ring-white/10">
                <span class="text-5xl font-bold text-white">{{ auth()->user()->initials() }}</span>
            </div>
            {{-- <button class="mt-5 bg-white text-indigo-700 font-semibold py-2 px-5 rounded-lg hover:bg-gray-200 transition-colors">
                Upload New Avatar
            </button>
            <p class="mt-2 text-sm text-indigo-200">Recommended size: 400x400px</p> --}}
        </div>

        {{-- <livewire:settings.delete-user-form /> --}}
    </x-settings.layout>
</section>
