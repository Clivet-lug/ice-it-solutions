<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <!-- Mobile Menu Button - Only visible on mobile -->
        <div class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-white shadow">
            <div class="flex items-center justify-between px-4 py-3">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-8 w-auto">
                </div>
                <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex">
            <!-- Sidebar - Hidden by default on mobile -->
            @include('partials.admin._sidebar')
            {{-- <div id="sidebar"
                class="fixed inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition duration-200 ease-in-out">
                @include('partials.admin._sidebar')
            </div> --}}


            <!-- Main Content -->
            <div class="flex-1 ml-64">
                <!-- Top Navigation -->
                <div class="bg-white shadow fixed top-0 right-0 left-0 lg:left-64 z-30">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-end h-16">
                            <div class="flex items-center">
                                <span class="text-gray-700 mr-4 hidden sm:inline">{{ Auth::user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-600 hover:text-gray-900">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                <main class="pt-16 py-6 px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Sweet Alert -->
    @include('partials._sweet-alert')

    @stack('scripts')

    <!-- Mobile Menu JavaScript -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
