@extends('admin.layouts.app')

@section('header', isset($service) ? 'Edit Service' : 'Create Service')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <form method="POST" action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($service)) @method('PUT') @endif

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $service->name ?? '') }}" 
                       class="mt-1 block w-full rounded-md border-gray-300">
            </div>

            <div>
                <label>Short Description</label>
                <textarea name="short_description" rows="2" 
                          class="mt-1 block w-full rounded-md border-gray-300">{{ old('short_description', $service->short_description ?? '') }}</textarea>
            </div>

            <div>
                <label>Full Description</label>
                <textarea name="description" rows="4" 
                          class="mt-1 block w-full rounded-md border-gray-300">{{ old('description', $service->description ?? '') }}</textarea>
            </div>

            <div>
                <label>Price</label>
                <input type="number" name="price" step="0.01" value="{{ old('price', $service->price ?? '') }}"
                       class="mt-1 block w-full rounded-md border-gray-300">
            </div>

            <div>
                <label>Image</label>
                <input type="file" name="image" class="mt-1 block w-full">
            </div>

            <div>
                <label>Features (one per line)</label>
                <textarea name="features" rows="4" 
                          class="mt-1 block w-full rounded-md border-gray-300">{{ old('features', isset($service) ? implode("\n", json_decode($service->features)) : '') }}</textarea>
            </div>

            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                           {{ (old('is_active', $service->is_active ?? true) ? 'checked' : '') }}
                           class="rounded border-gray-300">
                    <span class="ml-2">Active</span>
                </label>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                {{ isset($service) ? 'Update' : 'Create' }} Service
            </button>
        </div>
    </form>
</div>
@endsection