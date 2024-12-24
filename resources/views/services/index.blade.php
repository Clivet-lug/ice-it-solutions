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
                @forelse ($services as $service)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        @if ($service->image)
                            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}"
                                class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $service->short_description }}</p>

                            {{-- Safely handle features display --}}
                            @if ($service->features && is_array($service->features))
                                <ul class="mb-4 space-y-2">
                                    @foreach ($service->features as $feature)
                                        <li class="flex items-center text-gray-600">
                                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="flex justify-between items-center mt-6">
                                <span class="text-blue-600 font-bold">Starting at
                                    K{{ number_format($service->price, 2) }}</span>
                                <a href="{{ route('services.show', $service) }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">No services available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
