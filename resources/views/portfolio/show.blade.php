@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-16 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <a href="{{ route('portfolio.index') }}" class="text-blue-600 mb-8 inline-block">← Back to Portfolio</a>

            <!-- Project Header -->
            <div class="mb-8">
                <span class="text-blue-600 font-semibold">{{ ucfirst($project->type) }}</span>
                <h1 class="text-4xl font-bold mt-2">{{ $project->title }}</h1>
                @if ($project->client_name)
                    <p class="text-gray-600 mt-2">Client: {{ $project->client_name }}</p>
                @endif
            </div>

            <!-- Before/After Images -->
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                @if ($project->before_image)
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Before</h3>
                        <img src="{{ asset($project->before_image) }}" alt="Before" class="rounded-lg">
                    </div>
                @endif
                <div>
                    <h3 class="text-lg font-semibold mb-4">After</h3>
                    <img src="{{ asset($project->after_image) }}" alt="After" class="rounded-lg">
                </div>
            </div>

            <!-- Project Details -->
            <div class="prose max-w-none mb-8">
                <h3>Project Description</h3>
                {{ $project->description }}

                @if ($project->results)
                    <h3>Results & Impact</h3>
                    {{ $project->results }}
                @endif
            </div>

            <!-- Technologies -->
            @if ($project->technologies)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-4">Technologies Used</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($project->technologies as $tech)
                            <span class="px-3 py-1 bg-gray-100 rounded-full">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- CTA -->
            <div class="bg-gray-50 p-8 rounded-lg">
                <h3 class="text-2xl font-bold mb-4">Like what you see?</h3>
                <p class="mb-4">Let us help you create something amazing.</p>
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg inline-block">Get
                    Started</a>
            </div>
        </div>
    </div>
@endsection

<!-- resources/views/admin/portfolio/index.blade.php -->
@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <h2 class="text-2xl font-bold">Portfolio Projects</h2>
        <a href="{{ route('admin.portfolio.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Add Project</a>
    </div>

    <div class="bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($portfolios as $project)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img src="{{ asset($project->after_image) }}" alt=""
                                    class="h-10 w-10 rounded-full">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $project->title }}</div>
                                    @if ($project->client_name)
                                        <div class="text-sm text-gray-500">{{ $project->client_name }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($project->type) }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->is_featured ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $project->is_featured ? 'Featured' : 'Not Featured' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('admin.portfolio.edit', $project) }}"
                                class="text-blue-600 hover:text-blue-900">Edit</a>
                            <form action="{{ route('admin.portfolio.destroy', $project) }}" method="POST"
                                class="inline-block ml-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $portfolios->links() }}
        </div>
    </div>
@endsection
