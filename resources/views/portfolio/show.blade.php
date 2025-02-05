// resources/views/portfolio/show.blade.php

@extends('layouts.app')

@push('styles')
    <style>
        /* Image comparison slider */
        .image-comparison {
            position: relative;
            overflow: hidden;
        }

        .comparison-slider {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 2px;
            background: white;
            left: 50%;
            transform: translateX(-50%);
            cursor: ew-resize;
            z-index: 20;
        }

        .comparison-handle {
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        /* Loading animation */
        .image-loading {
            position: relative;
            background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite linear;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Scroll animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .tech-badge {
            transition: all 0.3s ease;
        }

        .tech-badge:hover {
            background-color: #3B4BA6;
            color: white;
            transform: translateY(-1px);
        }

        /* Before/After comparison styles */
        .comparison-section {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem;
        }

        .comparison-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .before-label,
        .after-label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            backdrop-filter: blur(4px);
        }
    </style>
@endpush

@section('content')
    <div class="bg-[#3B4BA6]/5 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Navigation -->
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('portfolio.index') }}"
                    class="flex items-center text-[#3B4BA6] hover:-translate-x-1 transition-transform duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Portfolio
                </a>

                @if ($portfolio->live_url)
                    <a href="{{ $portfolio->live_url }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-[#3B4BA6] text-white rounded-lg hover:bg-[#2D3A8C] transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Visit Live Project
                    </a>
                @endif
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="relative h-[50vh]">
                    @if ($portfolio->after_image)
                        <img src="{{ Storage::url($portfolio->after_image) }}" alt="{{ $portfolio->title }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/50 to-transparent"></div>
                    @endif

                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <div class="flex flex-wrap gap-3 mb-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                                {{ ucfirst($portfolio->type) }}
                                @if ($portfolio->sub_type)
                                    <span class="mx-1 text-white/50">&middot;</span>
                                    <span>{{ ucfirst($portfolio->sub_type) }}</span>
                                @endif
                            </span>

                            @if ($portfolio->project_status)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-500/20 text-white backdrop-blur-sm">
                                    {{ ucfirst($portfolio->project_status) }}
                                </span>
                            @endif
                        </div>
                        <h1 class="text-4xl font-bold text-white mb-2">{{ $portfolio->title }}</h1>
                        @if ($portfolio->client_name)
                            <p class="text-white/80">Client: {{ $portfolio->client_name }}</p>
                        @endif
                    </div>
                </div>

                <!-- Before/After Image Section -->
                @if ($portfolio->before_image && $portfolio->after_image)
                    <div class="p-8 border-b border-gray-200">

                        <h2 class="text-2xl font-bold mb-6">Project Transformation</h2>
                        <div class="grid md:grid-cols-2 gap-8">
                            <!-- Before Image -->
                            <div class="comparison-section aspect-video">
                                <img src="{{ Storage::url($portfolio->before_image) }}" alt="Before" class="rounded-xl">
                                <span class="before-label">Before</span>
                            </div>

                            <!-- After Image -->
                            <div class="comparison-section aspect-video">
                                <img src="{{ Storage::url($portfolio->after_image) }}" alt="After" class="rounded-xl">
                                <span class="after-label">After</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Project Details -->
                <div class="p-8 grid md:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="md:col-span-2 space-y-8">
                        @if ($portfolio->description)
                            <div>
                                <h3 class="text-xl font-bold mb-4">Project Description</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $portfolio->description }}</p>
                            </div>
                        @endif

                        @if ($portfolio->challenges)
                            <div>
                                <h3 class="text-xl font-bold mb-4">Challenges</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $portfolio->challenges }}</p>
                            </div>
                        @endif

                        @if ($portfolio->solutions)
                            <div>
                                <h3 class="text-xl font-bold mb-4">Solutions</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $portfolio->solutions }}</p>
                            </div>
                        @endif

                        @if ($portfolio->results)
                            <div>
                                <h3 class="text-xl font-bold mb-4">Results</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $portfolio->results }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-8">
                        <!-- Technologies -->
                        @if ($portfolio->technologies && is_array($portfolio->technologies))
                            <div>
                                <h3 class="text-xl font-bold mb-4">Technologies Used</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($portfolio->technologies as $tech)
                                        <span
                                            class="tech-badge px-3 py-1.5 bg-[#3B4BA6]/10 text-[#3B4BA6] rounded-full text-sm">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Project Metadata -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-xl font-bold mb-4">Project Details</h3>
                            <dl class="space-y-3">
                                @if ($portfolio->completion_date)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Completion Date</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($portfolio->completion_date)->format('F Y') }}</dd>
                                    </div>
                                @endif

                                @if ($portfolio->complexity_level)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Complexity Level</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $portfolio->complexity_level }}/5</dd>
                                    </div>
                                @endif

                                @if ($portfolio->user_base)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">User Base</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ number_format($portfolio->user_base) }}
                                            users</dd>
                                    </div>
                                @endif

                                @if ($portfolio->number_of_pages)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Number of Pages</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $portfolio->number_of_pages }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Document Download -->
                        @if ($portfolio->sample_file)
                            <div class="bg-gray-50 rounded-xl p-6">
                                <h3 class="text-xl font-bold mb-4">Sample Document</h3>
                                <a href="{{ Storage::url($portfolio->sample_file) }}" target="_blank"
                                    class="inline-flex items-center px-4 py-2 bg-[#3B4BA6] text-white rounded-lg hover:bg-[#2D3A8C] transition-colors duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download Sample
                                </a>
                            </div>
                        @endif

                        <!-- CTA -->
                        <div class="bg-[#3B4BA6]/5 rounded-xl p-6 border border-[#3B4BA6]/10">
                            <h3 class="text-xl font-bold mb-3">Interested in something similar?</h3>
                            <p class="text-gray-600 mb-4">Let's discuss how we can help bring your project to life.</p>
                            <a href="{{ route('contact') }}"
                                class="block w-full px-4 py-3 bg-[#3B4BA6] text-white text-center rounded-lg hover:bg-[#2D3A8C] transition-colors duration-300">
                                Get in Touch
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
