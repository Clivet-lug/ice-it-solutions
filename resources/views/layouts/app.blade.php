<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ICE IT Solutions</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="absolute top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <img class="h-8 w-auto" src="{{ asset('images/logo.jpg') }}" alt="ICE IT Solutions">
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-white hover:text-gray-200">PRODUCTS</a>
                    <a href="#" class="text-white hover:text-gray-200">SERVICES</a>
                    <a href="#" class="text-white hover:text-gray-200">RESOURCES</a>
                    <a href="#" class="text-white hover:text-gray-200">PRICING</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-white hover:text-gray-200">LOG IN</a>
                    <a href="#" class="bg-white text-blue-600 px-6 py-2 rounded-md hover:bg-gray-100">
                        GET STARTED
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
