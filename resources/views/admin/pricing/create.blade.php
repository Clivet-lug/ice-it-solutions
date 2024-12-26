@extends('admin.layouts.app')
@include('partials._alerts')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">{{ isset($pricing) ? 'Edit Pricing Plan' : 'Create New Pricing Plan' }}</h2>
            <a href="{{ route('admin.pricing.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Pricing</a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ isset($pricing) ? route('admin.pricing.update', $pricing) : route('admin.pricing.store') }}"
                method="POST" class="space-y-6">
                @csrf
                @if (isset($pricing))
                    @method('PUT')
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700">Plan Name</label>
                    <input type="text" name="name" value="{{ old('name', $pricing->name ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach (['website', 'document', 'presentation'] as $type)
                            <option value="{{ $type }}"
                                {{ old('type', $pricing->type ?? '') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">K</span>
                        </div>
                        <input type="number" name="price" step="0.01"
                            value="{{ old('price', $pricing->price ?? '') }}"
                            class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Features</label>
                    <div id="features-container" class="space-y-2">
                        @if (isset($pricing))
                            @foreach (json_decode($pricing->features) as $index => $feature)
                                <div class="flex gap-2">
                                    <input type="text" name="features[]" value="{{ $feature }}"
                                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <button type="button" onclick="removeFeature(this)"
                                        class="text-red-600 hover:text-red-800">Remove</button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-2">
                                <input type="text" name="features[]"
                                    class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Enter a feature">
                                <button type="button" onclick="removeFeature(this)"
                                    class="text-red-600 hover:text-red-800">Remove</button>
                            </div>
                        @endif
                    </div>
                    <button type="button" onclick="addFeature()" class="mt-2 text-sm text-blue-600 hover:text-blue-800">+
                        Add Feature</button>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Button Text</label>
                    <input type="text" name="button_text"
                        value="{{ old('button_text', $pricing->button_text ?? 'Get Started') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="flex items-center gap-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured', $pricing->is_featured ?? false) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Featured Plan</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $pricing->is_active ?? true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-600">Active</span>
                    </label>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.pricing.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        {{ isset($pricing) ? 'Update Plan' : 'Create Plan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function addFeature() {
                const container = document.getElementById('features-container');
                const div = document.createElement('div');
                div.className = 'flex gap-2';
                div.innerHTML = `
            <input type="text" name="features[]" 
                   class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   placeholder="Enter a feature">
            <button type="button" onclick="removeFeature(this)"
                    class="text-red-600 hover:text-red-800">Remove</button>
        `;
                container.appendChild(div);
            }

            function removeFeature(button) {
                const featuresCount = document.querySelectorAll('input[name="features[]"]').length;
                if (featuresCount > 1) {
                    button.parentElement.remove();
                }
            }
        </script>
    @endpush
@endsection
