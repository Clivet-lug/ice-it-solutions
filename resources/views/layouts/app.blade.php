<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ICE IT Solutions</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-blue-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <h1 class="text-xl font-bold text-blue-600">ICE IT Solutions</h1>
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">PRODUCTS</a>
                    <a href="{{ route('services') }}" class="text-blue-600 hover:text-blue-800">SERVICES</a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">RESOURCES</a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">PRICING</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800">LOG IN</a>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        GET STARTED
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold text-blue-600">Get in touch</h2>
                    <div class="space-y-2">
                        <p class="flex items-center">
                            <span class="text-blue-600 mr-2">📞</span>
                            <a href="tel:260970983828" class="hover:text-blue-600">260970983828</a>
                        </p>
                        <p class="flex items-center">
                            <span class="text-blue-600 mr-2">✉️</span>
                            <a href="mailto:iceit@gmail.com" class="hover:text-blue-600">iceit@gmail.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
