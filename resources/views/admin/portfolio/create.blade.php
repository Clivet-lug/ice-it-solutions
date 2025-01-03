@extends('admin.layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">{{ isset($project) ? 'Edit Project' : 'Add New Project' }}</h2>
            <a href="{{ route('admin.portfolio.index') }}" class="text-blue-600">← Back to Portfolio</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ isset($project) ? route('admin.portfolio.update', $project) : route('admin.portfolio.store') }}"
                method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if (isset($project))
                    @method('PUT')
                @endif

                <!-- Basic Information -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}"
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
                            <option value="{{ $type }}"
                                {{ old('type', $project->type ?? '') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Client Name (Optional)</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $project->client_name ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Images -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Before Image</label>
                        <input type="file" name="before_image" class="mt-1 block w-full">
                        @if (isset($project) && $project->before_image)
                            <div class="mt-2">
                                <img src="{{ asset($project->before_image) }}" class="h-24 w-auto">
                            </div>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">After Image (Required)</label>
                        <input type="file" name="after_image" class="mt-1 block w-full"
                            {{ isset($project) ? '' : 'required' }}>
                        @if (isset($project) && $project->after_image)
                            <div class="mt-2">
                                <img src="{{ asset($project->after_image) }}" class="h-24 w-auto">
                            </div>
                        @endif
                        @error('after_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description & Results -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Project Description</label>
                    <textarea name="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $project->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Results & Impact</label>
                    <textarea name="results" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('results', $project->results ?? '') }}</textarea>
                </div>

                <!-- Technologies -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Technologies (comma-separated)</label>
                    <input type="text" name="technologies"
                        value="{{ old('technologies', isset($project) ? implode(', ', $project->technologies ?? []) : '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="e.g. Laravel, Vue.js, PostgreSQL">
                </div>

                <!-- Featured Toggle -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1"
                        {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-700">
                        Feature this project
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ isset($project) ? 'Update Project' : 'Create Project' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
