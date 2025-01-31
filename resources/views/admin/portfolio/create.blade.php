@extends('admin.layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h2 class="text-xl sm:text-2xl font-bold">{{ isset($project) ? 'Edit Project' : 'Add New Project' }}</h2>
            <a href="{{ route('admin.portfolio.index') }}" class="text-blue-600 inline-flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Portfolio
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <form
                action="{{ isset($project) ? route('admin.portfolio.update', $project) : route('admin.portfolio.store') }}"
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
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Before Image</label>
                        <div id="beforeImageContainer"
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition-colors">
                            <div class="space-y-1 text-center">
                                <img id="beforePreview" src="{{ $project->before_image_url ?? '' }}"
                                    class="{{ isset($project->before_image) ? '' : 'hidden' }} mb-3 max-h-32 mx-auto">
                                <div class="flex text-sm text-gray-600">
                                    <label for="beforeImage"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="beforeImage" name="before_image" type="file" class="sr-only"
                                            accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                            </div>
                        </div>
                        @error('before_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">After Image (Required)</label>
                        <div id="afterImageContainer"
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition-colors">
                            <div class="space-y-1 text-center">
                                <img id="afterPreview" src="{{ $project->after_image_url ?? '' }}"
                                    class="{{ isset($project->after_image) ? '' : 'hidden' }} mb-3 max-h-32 mx-auto">
                                <div class="flex text-sm text-gray-600">
                                    <label for="afterImage"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload a file</span>
                                        <input id="afterImage" name="after_image" type="file" class="sr-only"
                                            accept="image/*" {{ isset($project) ? '' : 'required' }}>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                            </div>
                        </div>
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
                <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4">
                    <button type="submit"
                        class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ isset($project) ? 'Update Project' : 'Create Project' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function setupImagePreview(inputId, previewId) {
                    const input = document.getElementById(inputId);
                    const preview = document.getElementById(previewId);
                    const previewContainer = document.getElementById(previewId + 'Container');

                    // Setup drag and drop
                    previewContainer.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        this.classList.add('border-blue-500', 'bg-blue-50');
                    });

                    previewContainer.addEventListener('dragleave', function(e) {
                        e.preventDefault();
                        this.classList.remove('border-blue-500', 'bg-blue-50');
                    });

                    previewContainer.addEventListener('drop', function(e) {
                        e.preventDefault();
                        this.classList.remove('border-blue-500', 'bg-blue-50');

                        if (e.dataTransfer.files.length) {
                            input.files = e.dataTransfer.files;
                            handleFileSelect(input.files[0]);
                        }
                    });

                    // Handle file selection
                    input.addEventListener('change', function(e) {
                        if (this.files.length) {
                            handleFileSelect(this.files[0]);
                        }
                    });

                    function handleFileSelect(file) {
                        // Validate file type
                        if (!file.type.startsWith('image/')) {
                            alert('Please select an image file');
                            return;
                        }

                        // Validate file size (5MB max)
                        if (file.size > 5 * 1024 * 1024) {
                            alert('File size should not exceed 5MB');
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    }
                }

                // Initialize for both before and after images
                setupImagePreview('beforeImage', 'beforePreview');
                setupImagePreview('afterImage', 'afterPreview');
            });
        </script>
    @endpush
@endsection
