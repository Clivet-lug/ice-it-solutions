<nav x-data="{ open: false }"
    class="absolute top-0 left-0 right-0 z-50 {{ !request()->routeIs('home') ? 'bg-gray-100 shadow-lg backdrop-blur-sm bg-opacity-95' : '' }}">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Left Side: Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.jpg') }}" alt="ICE IT Solutions" class="h-12">
                </a>
            </div>

            <!-- Center: Main Navigation -->
            <div class="hidden md:flex space-x-8">
                @php
                    $navLinkClass = request()->routeIs('home')
                        ? 'text-white hover:text-gray-200'
                        : 'text-gray-800 hover:text-blue-600';
                @endphp

                <a href="{{ route('services') }}" class="{{ $navLinkClass }}">SERVICES</a>
                <a href="{{ route('portfolio.index') }}" class="{{ $navLinkClass }}">PORTFOLIO</a>
                <a href="#" class="{{ $navLinkClass }}">RESOURCES</a>
                <a href="{{ route('pricing.index') }}" class="{{ $navLinkClass }}">PRICING</a>
            </div>

            <!-- Right Side: Auth -->
            <div class="flex items-center space-x-4">
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
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-200">LOG IN</a>
                    <a href="{{ route('register') }}"
                        class="{{ request()->routeIs('home') ? 'bg-white text-blue-600' : 'bg-blue-600 text-white' }} 
                            px-6 py-2 rounded hover:opacity-90">
                        GET STARTED
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 {{ request()->routeIs('home') ? 'bg-black/80' : 'bg-blue-900' }}">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                @php
                    $mobileNavLinkClass = request()->routeIs('home')
                        ? 'text-white hover:bg-gray-700'
                        : 'text-gray-800 hover:bg-gray-100';
                @endphp
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('services')" :active="request()->routeIs('services')">
                {{ __('Services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.*')">
                {{ __('Portfolio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
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

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log In') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
