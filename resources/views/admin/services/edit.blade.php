@extends('admin.layouts.app')
@include('partials._alerts')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-3xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-semibold text-gray-900">Edit Service</h1>
                <a href="{{ route('admin.services.index') }}" class="text-blue-600 hover:text-blue-800">
                    Back to Services
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="mb-4">
                        <label for="short_description" class="block text-sm font-medium text-gray-700">
                            Short Description
                        </label>
                        <textarea name="short_description" id="short_description" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('short_description', $service->short_description) }}</textarea>
                        @error('short_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Full Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Full Description
                        </label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">K</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}"
                                step="0.01"
                                class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Features -->
                    <div class="mb-4">
                        <label for="features" class="block text-sm font-medium text-gray-700">Features</label>
                        <div id="features-container">
                            @foreach (old('features', $service->features ?? []) as $feature)
                                <div class="flex mt-2">
                                    <input type="text" name="features[]" value="{{ $feature }}"
                                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <button type="button" onclick="this.parentElement.remove()" class="ml-2 text-red-600">
                                        Remove
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" onclick="addFeature()"
                            class="mt-2 text-sm text-blue-600 hover:text-blue-800">
                            + Add Feature
                        </button>
                        @error('features')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Image -->
                    @if ($service->image)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Current Image</label>
                            <div class="mt-2">
                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}"
                                    class="h-32 w-32 object-cover rounded-lg">
                            </div>
                        </div>
                    @endif

                    <!-- New Image -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            {{ $service->image ? 'Update Image' : 'Add Image' }}
                        </label>
                        <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        <label for="is_active" class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">Active</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Update Service
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
                newFeature.className = 'flex mt-2';
                newFeature.innerHTML = `
        <input type="text" 
               name="features[]" 
               class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
               required>
        <button type="button" 
                onclick="this.parentElement.remove()"
                class="ml-2 text-red-600">
            Remove
        </button>
    `;
                container.appendChild(newFeature);
            }
        </script>
    @endpush
@endsection
