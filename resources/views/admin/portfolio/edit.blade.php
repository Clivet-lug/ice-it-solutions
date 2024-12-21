@extends('admin.layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Edit Project</h2>
            <a href="{{ route('admin.portfolio.index') }}" class="text-blue-600">← Back to Portfolio</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.portfolio.update', $project) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Project Type</label>
                    <select name="type"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach (['website', 'software', 'document', 'presentation'] as $type)
                            <option value="{{ $type }}" {{ $project->type == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Client Name (Optional)</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $project->client_name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Images with Preview -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Before Image</label>
                        @if ($project->before_image)
                            <div class="mt-2 mb-2">
                                <img src="{{ Storage::url($project->before_image) }}"
                                    class="h-32 w-auto object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="before_image" class="mt-1 block w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">After Image</label>
                        @if ($project->after_image)
                            <div class="mt-2 mb-2">
                                <img src="{{ Storage::url($project->after_image) }}"
                                    class="h-32 w-auto object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="after_image" class="mt-1 block w-full">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Project Description</label>
                    <textarea name="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $project->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Results & Impact</label>
                    <textarea name="results" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('results', $project->results) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Technologies</label>
                    <input type="text" name="technologies"
                        value="{{ old('technologies', implode(', ', $project->technologies ?? [])) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Laravel, Vue.js, PostgreSQL">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-700">
                        Feature this project
                    </label>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.portfolio.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Update Project
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
