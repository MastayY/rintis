<footer class="bg-white/10 backdrop-blur-sm mt-16">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <a href="{{ route('home') }}" wire:navigate class="mr-5 flex items-center space-x-2">
                    <x-app-logo class="size-10"></x-app-logo>
                </a>
                <p class="text-white/70 text-sm mb-4">
                    Empowering innovation through cutting-edge tools and solutions. Build, launch, and scale your ideas with our comprehensive platform.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-white/70 hover:text-white transition-colors">
                        <i class="fab fa-github text-xl"></i>
                    </a>
                    <a href="#" class="text-white/70 hover:text-white transition-colors">
                        <i class="fab fa-google text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Site Map -->
            <div>
                <h4 class="text-white font-semibold mb-4">Site Map</h4>
                <ul class="space-y-2 text-white/70 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Products</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Launches</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Community</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div>
                <h4 class="text-white font-semibold mb-4">Company</h4>
                <ul class="space-y-2 text-white/70 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Address</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h4 class="text-white font-semibold mb-4">Resources</h4>
                <ul class="space-y-2 text-white/70 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-white/20 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-white/70 text-sm">© 2025 Rintis.id. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-white/70 hover:text-white text-sm transition-colors">Terms of Service</a>
                <a href="#" class="text-white/70 hover:text-white text-sm transition-colors">Cookies Policy</a>
            </div>
        </div>
    </div>
</footer>


