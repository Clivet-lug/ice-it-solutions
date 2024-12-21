@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-16 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <nav class="mb-8">
                <a href="{{ route('portfolio.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Portfolio</a>
            </nav>

            <!-- Title Section -->
            <div class="mb-8">
                <span class="text-sm text-blue-600">{{ ucfirst($portfolio->type ?? 'Project') }}</span>
                <h1 class="text-3xl font-bold mt-2">{{ $portfolio->title ?? 'Project Details' }}</h1>
                @if (isset($portfolio->client_name))
                    <p class="text-gray-600 mt-2">Client: {{ $portfolio->client_name }}</p>
                @endif
            </div>

            <!-- Images Section -->
            <div class="mb-8">
                @if (isset($portfolio->before_image) || isset($portfolio->after_image))
                    <div class="grid md:grid-cols-2 gap-8">
                        @if (isset($portfolio->before_image))
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Before</h3>
                                <img src="{{ Storage::url($portfolio->before_image) }}" alt="Before"
                                    class="w-full rounded-lg shadow">
                            </div>
                        @endif
                        @if (isset($portfolio->after_image))
                            <div class="{{ !isset($portfolio->before_image) ? 'md:col-span-2' : '' }}">
                                <h3 class="text-lg font-semibold mb-4">After</h3>
                                <img src="{{ Storage::url($portfolio->after_image) }}" alt="After"
                                    class="w-full rounded-lg shadow">
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Description -->
            @if (isset($portfolio->description))
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-4">Project Description</h3>
                    <p class="text-gray-600">{{ $portfolio->description }}</p>
                </div>
            @endif

            <!-- Technologies -->
            @if (isset($portfolio->technologies) && is_array($portfolio->technologies) && count($portfolio->technologies) > 0)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-4">Technologies Used</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($portfolio->technologies as $tech)
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Results -->
            @if (isset($portfolio->results))
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-4">Results & Impact</h3>
                    <p class="text-gray-600">{{ $portfolio->results }}</p>
                </div>
            @endif

            <!-- CTA Section -->
            <div class="bg-gray-50 rounded-lg p-6 mt-8">
                <h3 class="text-xl font-semibold mb-2">Interested in something similar?</h3>
                <p class="text-gray-600 mb-4">Let's discuss your project requirements.</p>
                <a href="{{ route('contact') }}"
                    class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
@endsection
