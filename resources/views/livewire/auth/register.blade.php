<div class="flex-grow flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl p-8 sm:p-12 max-w-lg w-full">
        <div class="text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ __('global.create_an_account') }}</h2>
            <p class="text-gray-600 text-sm md:text-base">{{ __('global.create_an_account_description') }}</p>
        </div>

        <form wire:submit.prevent="register" class="mt-8 space-y-5">
            
            <div>
                <label for="name" class="text-sm font-medium text-gray-700">{{ __('users.name') }}</label>
                <input wire:model="name" id="name" name="name" type="text" placeholder="{{ __('users.your_full_name') }}" required autofocus autocomplete="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="username" class="text-sm font-medium text-gray-700">{{ __('users.username') }}</label>
                <input wire:model="username" id="username" type="text" name="username" required autocomplete="username" placeholder="{{ __('users.your_username') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="email" class="text-sm font-medium text-gray-700">{{ __('global.email_address') }}</label>
                <input wire:model="email" id="email" type="email" name="email" required autocomplete="email" placeholder="example@mail.com" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="relative">
                <label for="password" class="text-sm font-medium text-gray-700">{{ __('global.password') }}</label>
                <input wire:model="password" id="password" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('global.password') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="relative">
                <label for="password_confirmation" class="text-sm font-medium text-gray-700">{{ __('global.confirm_password') }}</label>
                <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{__('global.confirm_password')}}" placeholder="Confirm your password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-start">
                <input 
                    id="agree-terms" 
                    name="agree-terms" 
                    type="checkbox" 
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mt-1"
                    required
                >
                <label for="agree-terms" class="ml-3 block text-sm text-gray-700">
                    I agree to the <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">Terms of Service</a> and <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">Privacy Policy</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                id="submit-btn"
                wire:loading.attr="disabled"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm md:text-base font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <svg wire:loading wire:target="register" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                    </path>
                </svg>
                <span wire:loading.remove wire:target="register">{{ __('global.create_an_account') }}</span>
            </button>
        </form>

        <!-- Social Login Divider -->
        {{-- <div class="mt-8">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">Or sign up with</span>
                </div>
            </div>

            <!-- Social Login Buttons -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <button class="social-button flex items-center justify-center gap-3 px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5" />
                    <span class="text-sm font-medium">Google</span>
                </button>
                <button class="social-button flex items-center justify-center gap-3 px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <img src="https://www.svgrepo.com/show/512317/github-142.svg" alt="GitHub" class="w-5 h-5" />
                    <span class="text-sm font-medium">GitHub</span>
                </button>
            </div>
        </div> --}}

        <!-- Sign In Link -->
        <p class="mt-8 text-center text-sm text-gray-600">
            {{ __('global.already_have_an_account') }}
            <a href="{{ route('login') }}" wire:navigate class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                {{ __('global.sign_in') }}
            </a>
        </p>
    </div>
</div>

