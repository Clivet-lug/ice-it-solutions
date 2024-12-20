@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <!-- Featured Projects -->
        <div class="max-w-7xl mx-auto py-16 px-4">
            <h2 class="text-3xl font-bold mb-8">Featured Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($featured as $project)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ asset($project->after_image) }}" alt="{{ $project->title }}"
                            class="w-full h-48 object-cover">
                        <div class="p-6">
                            <span class="text-blue-600 text-sm font-semibold">{{ ucfirst($project->type) }}</span>
                            <h3 class="text-xl font-bold mt-2">{{ $project->title }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($project->description, 100) }}</p>
                            <a href="{{ route('portfolio.show', $project) }}" class="text-blue-600 mt-4 inline-block">View
                                Project →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-gray-100 py-8">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex gap-4">
                    <a href="{{ route('portfolio.index') }}"
                        class="px-4 py-2 rounded {{ !request('type') ? 'bg-blue-600 text-white' : 'bg-white' }}">All</a>
                    @foreach (['website', 'software', 'document', 'presentation'] as $type)
                        <a href="{{ route('portfolio.index', ['type' => $type]) }}"
                            class="px-4 py-2 rounded {{ request('type') === $type ? 'bg-blue-600 text-white' : 'bg-white' }}">
                            {{ ucfirst($type) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- All Projects -->
        <div class="max-w-7xl mx-auto py-16 px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($portfolios as $project)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="relative">
                            <img src="{{ asset($project->after_image) }}" alt="{{ $project->title }}"
                                class="w-full h-48 object-cover">
                            @if ($project->before_image)
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-50 opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <img src="{{ asset($project->before_image) }}" alt="Before" class="max-h-full">
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <span class="text-blue-600 text-sm font-semibold">{{ ucfirst($project->type) }}</span>
                            <h3 class="text-xl font-bold mt-2">{{ $project->title }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($project->description, 100) }}</p>
                            @if ($project->technologies)
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach ($project->technologies as $tech)
                                        <span class="px-2 py-1 bg-gray-100 rounded-full text-sm">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <a href="{{ route('portfolio.show', $project) }}" class="text-blue-600 mt-4 inline-block">View
                                Project →</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $portfolios->links() }}
        </div>
    </div>
@endsection
