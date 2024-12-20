@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="md:flex">
                    <!-- Service Image -->
                    <div class="md:flex-shrink-0">
                        <img class="h-96 w-full object-cover md:w-96" src="{{ asset($service->image) }}"
                            alt="{{ $service->name }}">
                    </div>

                    <!-- Service Details -->
                    <div class="p-8">
                        <div class="mb-8">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $service->name }}</h1>
                            <p class="text-gray-600">{{ $service->description }}</p>
                        </div>

                        <!-- Features -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">What's Included</h2>
                            <ul class="space-y-2">
                                @foreach ($service->features as $feature)
                                    <li class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Pricing -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Pricing</h2>
                            <p class="text-3xl font-bold text-blue-600">Starting at ${{ $service->price }}</p>
                        </div>

                        <!-- Request Button -->
                        <a href="{{ route('services.request', $service) }}"
                            class="inline-block bg-blue-600 text-white px-8 py-3 rounded-md hover:bg-blue-700">
                            Request This Service
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
