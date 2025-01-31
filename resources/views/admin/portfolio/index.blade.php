{{-- resources/views/admin/portfolio/index.blade.php --}}
@extends('admin.layouts.app')

@push('styles')
    <style>
        .truncate-tooltip {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .truncate-tooltip .truncated-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
        }

        .truncate-tooltip .tooltip-content {
            display: none;
            position: absolute;
            background-color: #1f2937;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.875rem;
            z-index: 50;
            white-space: normal;
            max-width: 300px;
            word-wrap: break-word;
            top: -10px;
            left: 50%;
            transform: translateX(-50%) translateY(-100%);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .truncate-tooltip .tooltip-content::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid #1f2937;
        }

        .truncate-tooltip:hover .tooltip-content {
            display: block;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Portfolio Projects</h1>
            <a href="{{ route('admin.portfolio.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Project
            </a>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($portfolios as $project)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="relative aspect-[16/9] overflow-hidden">
                        @if ($project->after_image)
                            <img src="{{ Storage::url($project->after_image) }}" alt="{{ $project->title }}"
                                class="w-full h-full object-cover">
                        @endif

                        @if ($project->is_featured)
                            <div class="absolute top-2 right-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Featured
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <div class="space-y-3">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($project->type) }}
                            </span>

                            <div class="truncate-tooltip">
                                <h3 class="truncated-text text-lg font-medium text-gray-900">
                                    {{ $project->title }}
                                </h3>
                                @if (strlen($project->title) > 25)
                                    <div class="tooltip-content">
                                        {{ $project->title }}
                                    </div>
                                @endif
                            </div>

                            @if ($project->client_name)
                                <div class="truncate-tooltip">
                                    <p class="truncated-text text-sm text-gray-600">
                                        Client: {{ $project->client_name }}
                                    </p>
                                    @if (strlen($project->client_name) > 25)
                                        <div class="tooltip-content">
                                            Client: {{ $project->client_name }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 flex justify-end space-x-4 pt-4 border-t">
                            <a href="{{ route('admin.portfolio.edit', $project) }}"
                                class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('admin.portfolio.destroy', $project) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center text-sm text-red-600 hover:text-red-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No projects</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new project.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.portfolio.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Add First Project
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($portfolios->hasPages())
            <div class="mt-6">
                {{ $portfolios->links() }}
            </div>
        @endif
    </div>
@endsection
