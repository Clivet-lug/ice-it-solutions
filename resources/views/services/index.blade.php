@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-b from-[#3B4BA6]/10 to-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Enhanced Header with Animation -->
            <div class="text-center mb-16 space-y-4">
                <h1 class="text-5xl font-bold text-gray-900 mb-4 animate-fade-in">
                    Our Services
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Choose from our professional services tailored to meet your needs
                </p>
                <div class="w-20 h-1 bg-[#3B4BA6] mx-auto rounded-full mt-4"></div>
            </div>

            <!-- Improved Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($services as $service)
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300 border border-gray-100">
                        @if ($service->image)
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ asset($service->image) }}" alt="{{ $service->name }}"
                                    class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            </div>
                        @endif

                        <div class="relative p-8 group">
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $service->name }}</h3>
                            <p
                                class="text-gray-600 mb-6 line-clamp-2 group-hover:line-clamp-none transition-all duration-300">
                                {{ $service->short_description }}</p>

                            @if ($service->features && is_array($service->features))
                                <ul class="mb-8 space-y-3">
                                    @foreach ($service->features as $feature)
                                        <li class="flex items-start space-x-3 text-gray-600">
                                            <div class="flex-shrink-0 w-5 h-5 mt-1">
                                                <div
                                                    class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center">
                                                    <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <span class="text-sm">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="flex flex-col space-y-4 mt-auto">
                                <div class="text-[#3B4BA6] font-bold text-lg">
                                    Starting at K{{ number_format($service->price, 2) }}
                                </div>
                                <a href="{{ route('services.show', ['service' => $service->slug]) }}"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-[#3B4BA6] text-white rounded-xl hover:bg-[#2D3A8C] transition-colors duration-300 group">
                                    View Details
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white rounded-2xl shadow-lg p-12 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                        <p class="text-gray-500 text-lg">No services available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Improved Pagination -->
            <div class="mt-12">
                {{ $services->links() }}
            </div>
        </div>
    </div>

    <!-- Add this to your CSS (app.css) -->

@endsection
