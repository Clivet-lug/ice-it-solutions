<aside class="bg-blue-900 text-white w-64 min-h-screen">
    <div class="p-6 flex items-center">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-8 w-auto mr-3 hidden lg:block">
        <h1 class="text-2xl font-bold">Admin Panel</h1>
    </div>

    <nav class="mt-6 space-y-1">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-6 py-3 hover:bg-blue-800 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('admin.services.index') }}"
            class="flex items-center px-6 py-3 hover:bg-blue-800 {{ request()->routeIs('admin.services.*') ? 'bg-blue-800' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Services
        </a>

        <a href="{{ route('admin.portfolio.index') }}"
            class="flex items-center px-6 py-3 hover:bg-blue-800 {{ request()->routeIs('admin.portfolio.*') ? 'bg-blue-800' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Portfolio
        </a>

        <a href="{{ route('admin.requests.index') }}"
            class="flex items-center px-6 py-3 hover:bg-blue-800 {{ request()->routeIs('admin.requests.*') ? 'bg-blue-800' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Service Requests
        </a>

        <a href="{{ route('admin.pricing.index') }}"
            class="flex items-center px-6 py-3 hover:bg-blue-800 {{ request()->routeIs('admin.pricing.*') ? 'bg-blue-800' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Pricing
        </a>
        <a href="{{ route('admin.pricing-requests.index') }}"
            class="flex items-center px-6 py-3 hover:bg-blue-800 {{ request()->routeIs('admin.pricing-requests.*') ? 'bg-blue-800' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            Pricing Requests
        </a>
    </nav>
</aside>
