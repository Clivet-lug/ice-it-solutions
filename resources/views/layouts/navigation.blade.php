<nav x-data="{ open: false }"
    class="absolute top-0 left-0 right-0 z-50 {{ !request()->routeIs('home') ? 'bg-[#3B4BA6] shadow-lg backdrop-blur-sm bg-opacity-95' : 'bg-transparent' }}">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Left Side: Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="block">
                    <img src="{{ asset('images/logo.jpg') }}" alt="ICE IT Solutions" class="h-12 w-auto object-contain">
                </a>
            </div>

            <!-- Center: Main Navigation -->
            <div class="hidden md:flex space-x-8">
                @php
                    $navLinkClass = request()->routeIs('home')
                        ? 'text-white hover:text-gray-200 font-medium transition duration-300'
                        : 'text-white hover:text-blue-100 font-medium transition duration-300';
                @endphp

                <a href="{{ route('services') }}" class="{{ $navLinkClass }}">SERVICES</a>
                <a href="{{ route('pricing.index') }}" class="{{ $navLinkClass }}">PRICING</a>
                <a href="{{ route('portfolio.index') }}" class="{{ $navLinkClass }}">PORTFOLIO</a>
                <a href="#" class="{{ $navLinkClass }}">RESOURCES</a>
            </div>

            <!-- Right Side: Auth -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="{{ $navLinkClass }}">ADMIN</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="{{ $navLinkClass }}">
                            LOGOUT
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-300">LOG IN</a>
                    <a href="{{ route('register') }}"
                        class="{{ request()->routeIs('home')
                            ? 'bg-white text-[#5B89AF] hover:bg-blue-50'
                            : 'bg-white text-[#5B89AF] hover:bg-blue-50' }} 
        px-6 py-2 rounded-lg font-medium transition duration-300 shadow-sm">
                        GET STARTED
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="flex md:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none transition duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="md:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-[#4052B5]/95 backdrop-blur-sm">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="block px-4 py-2 text-white hover:bg-white/10 transition duration-300">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('services')" :active="request()->routeIs('services')"
                class="block px-4 py-2 text-white hover:bg-white/10 transition duration-300">
                {{ __('Services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pricing.index')" :active="request()->routeIs('pricing.*')"
                class="block px-4 py-2 text-white hover:bg-white/10 transition duration-300">
                {{ __('Pricing') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.*')"
                class="block px-4 py-2 text-white hover:bg-white/10 transition duration-300">
                {{ __('Portfolio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')"
                class="block px-4 py-2 text-white hover:bg-white/10 transition duration-300">
                {{ __('Contact') }}
            </x-responsive-nav-link>

            @auth
                @if (auth()->user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')"
                        class="block px-4 py-2 text-white hover:bg-white/10 transition duration-300">
                        {{ __('Admin') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Mobile Auth Menu -->
        @auth
            <div class="pt-4 pb-1 border-t border-blue-400/30 bg-[#5B89AF]/95 backdrop-blur-sm">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-blue-100">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                        this.closest('form').submit();"
                            class="block px-4 py-2 text-white hover:bg-white/10 transition duration-300">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-blue-400/30 bg-[#5B89AF]/95 backdrop-blur-sm">
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')"
                        class="block px-4 py-2 text-white hover:bg-white/10 transition duration-300">
                        {{ __('Log In') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')"
                        class="block px-4 py-2 text-white hover:bg-white/10 transition duration-300">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
