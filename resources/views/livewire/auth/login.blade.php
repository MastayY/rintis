<div class="bg-white p-8 md:p-12 rounded-lg shadow-xl w-full max-w-md my-12 md:my-20 fade-in">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Masuk</h2>
        <p class="text-gray-500 mt-2 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <form wire:submit.prevent="login" id="loginForm" class="space-y-6">
        {{-- EMAIL FIELD --}}
        <div class="mb-6 input-group">
            <label for="email" class="block text-sm font-medium text-gray-500 mb-1">{{ __('global.email_address') }}</label>
            <input wire:model.debounce.500ms="email" type="email" id="email" placeholder="example@mail.com" required autofocus autocomplete="email"
                class="text-black w-full px-4 py-2 outline-none border @error('validation') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('validation')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- PASSWORD FIELD WITH TOGGLE --}}
        <div class="mb-4 input-group">
            <label for="password" class="block text-sm font-medium text-gray-500 mb-1">{{ __('global.password') }}</label>
            <div class="relative">
                <input wire:model="password" type="password" id="password"
                    class="text-black w-full px-4 py-2 outline-none border @error('validation') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Enter your password" autocomplete="current-password">
            </div>
            @error('validation')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- REMEMBER ME AND FORGOT PASSWORD --}}

        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input wire:model="remember" id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember-me" class="ml-2 block text-sm text-gray-500">{{ __('global.remember_me') }}</label>
            </div>
            <div class="text-sm">
                <a href="{{ route('password.request') }}" wire:navigate class="font-medium text-indigo-600 hover:text-indigo-500 text-sm">{{ __('global.forgot_password') }}</a>
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 disabled:opacity-50 cursor-pointer" wire:loading.attr="disabled">
                <svg wire:loading wire:target="login" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                    </path>
                </svg>
                <span wire:loading.remove wire:target="login">{{ __('global.log_in') }}</span>
            </button>
        </div>
    </form>

    {{-- login with social --}}
    {{-- <div class="mt-6">
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">
                    Or continue with
                </span>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-4">
            <button class="flex items-center justify-center gap-2 px-4 py-2 border rounded-md hover:bg-gray-50 transition-colors social-btn">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5" />
                <span class="text-sm font-medium">Google</span>
            </button>
            <button class="flex items-center justify-center gap-2 px-4 py-2 border rounded-md hover:bg-gray-50 transition-colors social-btn">
                <img src="https://www.svgrepo.com/show/512317/github-142.svg" alt="GitHub" class="w-5 h-5" />
                <span class="text-sm font-medium">GitHub</span>
            </button>
        </div>
    </div> --}}

    <p class="mt-8 text-center text-sm text-gray-600">
        {{ __('global.dont_have_an_account') }}
        <a href="{{ route('register') }}" wire:navigate class="font-medium text-indigo-600 hover:text-indigo-500">
            {{ __('global.sign_up') }}
        </a>
    </p>
</div>
