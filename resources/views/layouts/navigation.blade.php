<nav x-data="{ open: false }"
    class="absolute top-0 left-0 right-0 z-50 transition-all duration-300 {{ !request()->routeIs('home') ? 'bg-[#3B4BA6] shadow-lg backdrop-blur-sm bg-opacity-95' : 'bg-transparent' }}">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
            <!-- Left Side: Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="block">
                    <img src="{{ asset('images/logo.jpg') }}" alt="ICE IT Solutions"
                        class="h-8 md:h-12 w-auto object-contain transition-all duration-300">
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
                    class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none transition duration-300"
                    aria-label="Toggle menu">
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
    <div :class="{ 'block': open, 'hidden': !open }" {{-- class="md:hidden fixed top-16 left-0 right-0 bottom-0 bg-[#3B4BA6] overflow-y-auto transition-transform duration-300"
        @click.away="open = false"> --}}>
        <!-- Navigation Links -->
        <div class="bg-[#3B4BA6]">
            <div class="px-4 py-2">
                <a href="{{ route('home') }}"
                    class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg transition-colors
                {{ request()->routeIs('home') ? 'bg-white/10' : '' }}">
                    Home
                </a>
                <a href="{{ route('services') }}"
                    class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg transition-colors
                {{ request()->routeIs('services') ? 'bg-white/10' : '' }}">
                    Services
                </a>
                <a href="{{ route('pricing.index') }}"
                    class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg transition-colors
                {{ request()->routeIs('pricing.*') ? 'bg-white/10' : '' }}">
                    Pricing
                </a>
                <a href="{{ route('portfolio.index') }}"
                    class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg transition-colors
                {{ request()->routeIs('portfolio.*') ? 'bg-white/10' : '' }}">
                    Portfolio
                </a>
                <a href="#"
                    class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg transition-colors
                {{ request()->routeIs('resources') ? 'bg-white/10' : '' }}">
                    Resources
                </a>
            </div>

            <!-- Auth Links -->
            <div class="border-t border-white/10 px-4 py-3">
                @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg transition-colors">
                            Admin Dashboard
                        </a>
                    @endif

                    <div class="px-4 py-2">
                        <div class="text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-white/70">{{ Auth::user()->email }}</div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-3 text-white bg-white/10 hover:bg-white/20 rounded-lg transition-colors text-center">
                            Logout
                        </button>
                    </form>
                @else
                    <div class="space-y-2">
                        <a href="{{ route('login') }}"
                            class="block px-4 py-3 text-white hover:bg-white/10 rounded-lg transition-colors text-center">
                            Log In
                        </a>
                        <a href="{{ route('register') }}"
                            class="block px-4 py-3 bg-white text-[#3B4BA6] hover:bg-gray-100 rounded-lg transition-colors text-center">
                            Get Started
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
