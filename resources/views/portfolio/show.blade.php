@extends('layouts.app')

@section('content')
    <div class="bg-[#3B4BA6]/5 min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Navigation -->
            <nav class="mb-12">
                <a href="{{ route('portfolio.index') }}"
                    class="inline-flex items-center text-[#3B4BA6] hover:translate-x-[-4px] transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Portfolio
                </a>
            </nav>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <!-- Hero Section -->
                <div class="relative h-[40vh] bg-gray-900">
                    @if (isset($portfolio->after_image))
                        <img src="{{ Storage::url($portfolio->after_image) }}" alt="{{ $portfolio->title }}"
                            class="w-full h-full object-cover opacity-90">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 to-transparent"></div>
                    @endif

                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                            {{ ucfirst($portfolio->type ?? 'Project') }}
                        </span>
                        <h1 class="text-4xl font-bold text-white mt-4">{{ $portfolio->title ?? 'Project Details' }}</h1>
                        @if (isset($portfolio->client_name))
                            <p class="text-white/80 mt-2">Client: {{ $portfolio->client_name }}</p>
                        @endif
                    </div>
                </div>

                <div class="p-8">
                    <!-- Images Section with Before/After Comparison -->
                    @if (isset($portfolio->before_image) && isset($portfolio->after_image))
                        <div class="mb-12">
                            <h3 class="text-xl font-bold mb-6">Project Transformation</h3>
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <div class="relative aspect-video rounded-xl overflow-hidden shadow-lg">
                                        <img src="{{ Storage::url($portfolio->before_image) }}" alt="Before"
                                            class="w-full h-full object-cover">
                                        <div
                                            class="absolute top-4 left-4 px-3 py-1 bg-black/50 text-white text-sm rounded-full backdrop-blur-sm">
                                            Before
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div class="relative aspect-video rounded-xl overflow-hidden shadow-lg">
                                        <img src="{{ Storage::url($portfolio->after_image) }}" alt="After"
                                            class="w-full h-full object-cover">
                                        <div
                                            class="absolute top-4 left-4 px-3 py-1 bg-[#3B4BA6]/50 text-white text-sm rounded-full backdrop-blur-sm">
                                            After
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Project Details -->
                    <div class="grid md:grid-cols-3 gap-12">
                        <!-- Left Column: Description -->
                        <div class="md:col-span-2 space-y-8">
                            @if (isset($portfolio->description))
                                <div>
                                    <h3 class="text-xl font-bold mb-4">Project Description</h3>
                                    <p class="text-gray-600 leading-relaxed">{{ $portfolio->description }}</p>
                                </div>
                            @endif

                            @if (isset($portfolio->results))
                                <div>
                                    <h3 class="text-xl font-bold mb-4">Results & Impact</h3>
                                    <p class="text-gray-600 leading-relaxed">{{ $portfolio->results }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Right Column: Technologies & CTA -->
                        <div class="space-y-8">
                            @if (isset($portfolio->technologies) && is_array($portfolio->technologies) && count($portfolio->technologies) > 0)
                                <div>
                                    <h3 class="text-xl font-bold mb-4">Technologies Used</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($portfolio->technologies as $tech)
                                            <span
                                                class="px-3 py-1.5 bg-[#3B4BA6]/10 text-[#3B4BA6] rounded-full text-sm font-medium">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Enhanced CTA Section -->
                            <div class="bg-[#3B4BA6]/5 rounded-2xl p-6 border border-[#3B4BA6]/10">
                                <h3 class="text-xl font-bold mb-3">Interested in something similar?</h3>
                                <p class="text-gray-600 mb-6">Let's discuss your project requirements and create something
                                    amazing together.</p>
                                <a href="{{ route('contact') }}"
                                    class="inline-flex items-center justify-center w-full px-6 py-3 bg-[#3B4BA6] text-white rounded-xl hover:bg-[#2D3A8C] transition-colors duration-300">
                                    Get in Touch
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
