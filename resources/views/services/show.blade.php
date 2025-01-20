@extends('layouts.app')

@section('content')
    <!-- Hero Section with Parallax Effect -->
    <div class="relative h-[60vh] overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            {{-- <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover"> --}}
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 to-blue-800/75"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-center h-full">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">
                    {{ $service->name }}
                </h1>
                <p class="text-xl text-blue-100 max-w-2xl">
                    {{ $service->description }}
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Features Grid -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">What's Included</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($service->features as $feature)
                    <div
                        class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:border-blue-500 transition-colors duration-300">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-lg text-gray-700">{{ $feature }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pricing Section -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 md:p-12 mb-16">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Pricing</h2>
                <div class="mb-8">
                    <span class="text-5xl font-bold text-blue-900">K{{ $service->price }}</span>
                    <span class="text-gray-600 ml-2">starting price</span>
                </div>

                <!-- CTA Button -->
                <a href="{{ route('services.request', $service) }}"
                    class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                    Request This Service
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Contact Support Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Need More Information?</h3>
                <p class="text-gray-600 mb-6">Our team is here to answer any questions you might have about this service</p>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                    Contact Support
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection
