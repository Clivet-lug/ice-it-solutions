<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ICE IT Solutions') }} - Admin</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-900 transition duration-300">
            <div class="flex items-center justify-center h-20">
                <div class="text-white text-2xl font-bold">Admin Panel</div>
            </div>

            <nav class="mt-5 px-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="group flex items-center px-2 py-2 text-white hover:bg-blue-700 rounded-md">
                    Dashboard
                </a>
                <a href="{{ route('admin.services.index') }}"
                    class="group flex items-center px-2 py-2 text-white hover:bg-blue-700 rounded-md">
                    Services
                </a>
                <a href="{{ route('admin.portfolio.index') }}"
                    class="group flex items-center px-2 py-2 text-white hover:bg-blue-700 rounded-md">
                    Portfolio
                </a>
                <a href="{{ route('admin.requests.index') }}"
                    class="group flex items-center px-2 py-2 text-white hover:bg-blue-700 rounded-md">
                    Service Requests
                </a>
                <a href="{{ route('admin.pricing.index') }}"
                    class="group flex items-center px-2 py-2 text-white hover:bg-blue-700 rounded-md">
                    Pricng
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-64">
            <!-- Top Nav -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800">
                        @yield('header')
                    </h2>
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-4">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
