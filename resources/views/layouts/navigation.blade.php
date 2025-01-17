<nav x-data="{ open: false }"
    class="absolute top-0 left-0 right-0 z-50 {{ !request()->routeIs('home') ? 'bg-[#5B89AF] shadow-lg backdrop-blur-sm bg-opacity-95' : 'bg-transparent' }}">
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
                        ? 'text-white hover:text-gray-900'
                        : 'text-gray-800 hover:text-blue-300';
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
                        class="{{ request()->routeIs('home') ? 'bg-white text-blue-600' : 'bg-blue-600 text-white' }} 
                            px-6 py-2 rounded hover:opacity-90">
                        GET STARTED
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="flex md:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-blue-700/50 focus:outline-none">
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
        <div class="pt-2 pb-3 space-y-1 bg-white shadow-lg">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('services')" :active="request()->routeIs('services')"
                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                {{ __('Services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pricing.index')" :active="request()->routeIs('pricing.*')"
                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                {{ __('Pricing') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.*')"
                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                {{ __('Portfolio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')"
                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                {{ __('Contact') }}
            </x-responsive-nav-link>

            @auth
                @if (auth()->user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                        {{ __('Admin') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Mobile Auth Menu -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                            this.closest('form').submit();"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 bg-white">
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                        {{ __('Log In') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
