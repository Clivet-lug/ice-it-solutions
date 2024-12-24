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
        <div class="flex">
            <!-- Sidebar -->
            @include('partials.admin._sidebar')

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Top Navigation -->
                <div class="bg-white shadow">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-end h-16">
                            <div class="flex items-center">
                                <span class="text-gray-700 mr-4">{{ Auth::user()->name }}</span>
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
                <main class="py-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Sweet Alert -->
    @include('partials._sweet-alert')

    @stack('scripts')
</body>

</html>
