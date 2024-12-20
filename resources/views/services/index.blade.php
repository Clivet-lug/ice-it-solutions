@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Our Services</h1>
                <p class="text-xl text-gray-600">Choose from our professional services</p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $service->short_description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">Starting at ${{ $service->price }}</span>
                                <a href="{{ route('services.show', $service) }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
