@extends('admin.layouts.app')
@include('partials._alerts')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
                <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Create New Service</h1>
                <a href="{{ route('admin.services.index') }}"
                    class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Services
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label for="short_description" class="block text-sm font-medium text-gray-700">
                            Short Description
                        </label>
                        <textarea name="short_description" id="short_description" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('short_description') }}</textarea>
                        @error('short_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Full Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Full Description
                        </label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">K</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01"
                                class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Features -->
                    <div>
                        <label for="features" class="block text-sm font-medium text-gray-700">Features</label>
                        <div id="features-container" class="space-y-2">
                            @if (old('features'))
                                @foreach (old('features') as $index => $feature)
                                    <div class="flex gap-2">
                                        <input type="text" name="features[]" value="{{ $feature }}"
                                            class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            required>
                                        <button type="button" onclick="this.parentElement.remove()"
                                            class="text-red-600 hover:text-red-800 px-2">
                                            Remove
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex gap-2">
                                    <input type="text" name="features[]"
                                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addFeature()"
                            class="mt-2 text-sm text-blue-600 hover:text-blue-800 inline-flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Feature
                        </button>
                        @error('features')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="is_active" class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                {{ old('is_active') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">Active</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Create Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function addFeature() {
                const container = document.getElementById('features-container');
                const newFeature = document.createElement('div');
                newFeature.className = 'flex gap-2';
                newFeature.innerHTML = `
                    <input type="text" 
                           name="features[]" 
                           class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           required>
                    <button type="button" 
                            onclick="this.parentElement.remove()"
                            class="text-red-600 hover:text-red-800 px-2">
                        Remove
                    </button>
                `;
                container.appendChild(newFeature);
            }
        </script>
    @endpush
@endsection
