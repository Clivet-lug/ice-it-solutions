@extends('admin.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Portfolio Projects</h1>
            <a href="{{ route('admin.portfolio.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Add New Project
            </a>
        </div>

        <!-- Projects Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Featured</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($portfolios as $project)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if ($project->after_image)
                                        <img src="{{ Storage::url($project->after_image) }}" alt=""
                                            class="h-10 w-10 rounded-full object-cover mr-3">
                                    @endif
                                    <div>
                                        {{ $project->title }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ ucfirst($project->type) }}</td>
                            <td class="px-6 py-4">{{ $project->client_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex px-2 py-1 text-xs rounded-full {{ $project->is_featured ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $project->is_featured ? 'Featured' : 'Not Featured' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('admin.portfolio.edit', $project) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <form action="{{ route('admin.portfolio.destroy', $project) }}" method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No portfolio projects found. <a href="{{ route('admin.portfolio.create') }}"
                                    class="text-blue-600">Add your first project</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            @if ($portfolios->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $portfolios->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
