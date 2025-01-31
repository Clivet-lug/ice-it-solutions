@extends('layouts.app')

@section('content')
    <div class="bg-[#3B4BA6]/5">
        <!-- Featured Projects Section -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900">Featured Projects</h2>
                <div class="w-20 h-1 bg-[#3B4BA6] mx-auto rounded-full mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($featured as $project)
                    <div
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="relative aspect-video overflow-hidden">
                            <img src="{{ $project->after_image_url }}" alt="{{ $project->title }}"
                                class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>

                        <div class="p-6">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#3B4BA6]/10 text-[#3B4BA6]">
                                {{ ucfirst($project->type) }}
                            </span>
                            <h3 class="text-xl font-bold mt-3 text-gray-900">{{ $project->title }}</h3>
                            <p
                                class="text-gray-600 mt-2 text-sm line-clamp-2 group-hover:line-clamp-none transition-all duration-300">
                                {{ $project->description }}
                            </p>
                            <a href="{{ route('portfolio.show', $project) }}"
                                class="inline-flex items-center text-[#3B4BA6] font-medium mt-4 group-hover:translate-x-2 transition-transform duration-300">
                                View Project
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Enhanced Filter Section -->
        <div class="border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('portfolio.index') }}"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                        {{ !request('type')
                            ? 'bg-[#3B4BA6] text-white ring-2 ring-[#3B4BA6] ring-offset-2'
                            : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
                        All Projects
                    </a>
                    @foreach (['website', 'software', 'document', 'presentation'] as $type)
                        <a href="{{ route('portfolio.index', ['type' => $type]) }}"
                            class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                            {{ request('type') === $type
                                ? 'bg-[#3B4BA6] text-white ring-2 ring-[#3B4BA6] ring-offset-2'
                                : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
                            {{ ucfirst($type) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- All Projects Section -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($portfolios as $project)
                    <div
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="relative aspect-video overflow-hidden">
                            <img src="{{ $project->after_image_url }}" alt="{{ $project->title }}"
                                class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500">

                            @if ($project->before_image)
                                <div
                                    class="absolute inset-0 bg-black/75 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <img src="{{ $project->before_image_url }}" alt="Before"
                                        class="max-h-[80%] max-w-[80%] object-contain rounded shadow-lg">
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#3B4BA6]/10 text-[#3B4BA6]">
                                {{ ucfirst($project->type) }}
                            </span>
                            <h3 class="text-xl font-bold mt-3 text-gray-900">{{ $project->title }}</h3>
                            <p
                                class="text-gray-600 mt-2 text-sm line-clamp-2 group-hover:line-clamp-none transition-all duration-300">
                                {{ $project->description }}
                            </p>

                            @if ($project->technologies)
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach ($project->technologies as $tech)
                                        <span class="px-3 py-1 bg-gray-100 rounded-full text-xs text-gray-600">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <a href="{{ route('portfolio.show', $project) }}"
                                class="inline-flex items-center text-[#3B4BA6] font-medium mt-4 group-hover:translate-x-2 transition-transform duration-300">
                                View Project
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination with brand colors -->
            <div class="mt-12">
                {{ $portfolios->links() }}
            </div>
        </div>
    </div>
@endsection
