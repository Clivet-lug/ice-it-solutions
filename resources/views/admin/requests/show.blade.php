@extends('admin.layouts.app')
@include('partials._alerts')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-semibold text-gray-900">Request Details</h1>
                <a href="{{ route('admin.requests.index') }}" class="text-blue-600 hover:text-blue-800">
                    Back to Requests
                </a>
            </div>

            <!-- Main Content -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Status Update Form -->
                <div class="p-6 bg-gray-50 border-b">
                    <form action="{{ route('admin.requests.update', $request) }}" method="POST" class="flex gap-4">
                        @csrf
                        @method('PUT')
                        <select name="status" class="rounded-lg border-gray-300 flex-1">
                            <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $request->status == 'processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="completed" {{ $request->status == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="cancelled" {{ $request->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Update Status
                        </button>
                    </form>
                </div>

                <!-- Request Information -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Client Information -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Client Information</h2>
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $request->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="mailto:{{ $request->email }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $request->email }}
                                    </a>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Submitted On</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $request->created_at->format('F d, Y \a\t h:i A') }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Service Information -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Service Details</h2>
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Service</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $request->service->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Price</dt>
                                <dd class="mt-1 text-sm text-gray-900">K{{ number_format($request->service->price, 2) }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Request Description -->
                    <div class="col-span-full">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Request Description</h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $request->description }}</p>
                        </div>
                    </div>

                    <!-- Attachments -->
                    @if ($request->attachments)
                        <div class="col-span-full">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Attachments</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach ($request->attachments as $index => $attachment)
                                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                </path>
                                            </svg>
                                            <span class="ml-2 text-sm text-gray-600">
                                                {{ $attachment['original_name'] ?? 'File ' . ($index + 1) }}
                                            </span>
                                        </div>
                                        <a href="{{ route('admin.requests.download', ['request' => $request->id, 'attachmentIndex' => $index]) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            Download
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Admin Notes -->
                    <div class="col-span-full">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Admin Notes</h2>
                        <form action="{{ route('admin.requests.update', $request) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <textarea name="admin_notes" rows="4"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Add administrative notes here...">{{ old('admin_notes', $request->admin_notes) }}</textarea>
                            <div class="mt-2 flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                    Save Notes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Request -->
                <div class="p-6 bg-gray-50 border-t">
                    <form id="delete-form-{{ $service->id }}" action="{{ route('admin.services.destroy', $service) }}"
                        method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete('delete-form-{{ $service->id }}')"
                            class="text-red-600 hover:text-red-900">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg" x-data="{ show: true }"
            x-show="show" x-init="setTimeout(() => show = false, 3000)">
            {{ session('success') }}
        </div>
    @endif
@endsection
