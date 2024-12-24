@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header with Back Button -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-semibold text-gray-900">Request Details</h1>
                    <p class="mt-1 text-sm text-gray-500">Request ID: #{{ $request->id }}</p>
                </div>
                <a href="{{ route('admin.requests.index') }}"
                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">
                    ← Back to Requests
                </a>
            </div>

            <!-- Main Content -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Status Banner -->
                <div class="px-6 py-4 bg-gray-50 border-b flex justify-between items-center">
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span
                            class="ml-2 px-3 py-1 rounded-full text-sm font-medium
                        {{ $request->status === 'completed'
                            ? 'bg-green-100 text-green-800'
                            : ($request->status === 'in_progress'
                                ? 'bg-blue-100 text-blue-800'
                                : ($request->status === 'cancelled'
                                    ? 'bg-red-100 text-red-800'
                                    : 'bg-yellow-100 text-yellow-800')) }}">
                            {{ ucfirst($request->status) }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-500">
                        Submitted: {{ $request->created_at->format('M d, Y \a\t h:i A') }}
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <!-- Client Information -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Client Information</h2>
                        <dl class="grid grid-cols-1 gap-3">
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
                        </dl>
                    </div>

                    <!-- Service Information -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Service Details</h2>
                        <dl class="grid grid-cols-1 gap-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Service Type</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $request->service->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Service Price</dt>
                                <dd class="mt-1 text-sm text-gray-900">K{{ number_format($request->service->price, 2) }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Request Description -->
                    <div class="col-span-full">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Request Description</h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $request->description }}</p>
                        </div>
                    </div>

                    <!-- Attachments -->
                    @if ($request->attachments && count($request->attachments) > 0)
                        <div class="col-span-full">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Attachments</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($request->attachments as $index => $attachment)
                                    <div class="flex items-center justify-between bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                            </svg>
                                            <span class="ml-2 text-sm text-gray-600">
                                                {{ $attachment['original_name'] ?? 'File ' . ($index + 1) }}
                                            </span>
                                        </div>
                                        <a href="{{ route('admin.requests.download', ['request' => $request->id, 'attachmentIndex' => $index]) }}"
                                            class="text-sm text-blue-600 hover:text-blue-800">
                                            Download
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Update Status Form -->
                    <div class="col-span-full">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Update Status</h2>

                        @if ($errors->any())
                            <div class="mb-4 bg-red-50 text-red-600 p-4 rounded-lg">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.requests.update', $request) }}" method="POST"
                            class="bg-gray-50 rounded-lg p-4">
                            @csrf
                            @method('PUT')

                            <!-- Debug info - remove in production -->
                            <input type="hidden" name="debug_id" value="{{ $request->id }}">

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="col-span-2">
                                    <select name="status"
                                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                        <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="in_progress"
                                            {{ $request->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ $request->status === 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                        <option value="cancelled" {{ $request->status === 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                        Update Status
                                    </button>
                                </div>
                            </div>

                            <!-- Current Status Debug - remove in production -->
                            <div class="mt-2 text-xs text-gray-500">
                                Current status: {{ $request->status }}
                            </div>

                            <!-- Admin Notes -->
                            <div class="mt-4">
                                <label for="admin_notes" class="block text-sm font-medium text-gray-700">Admin Notes</label>
                                <textarea name="admin_notes" id="admin_notes" rows="4"
                                    class="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Add internal notes about this request...">{{ old('admin_notes', $request->admin_notes) }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Request -->
            <div class="mt-6 flex justify-end">
                <form action="{{ route('admin.requests.destroy', $request) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this request? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Delete Request
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('partials._sweet-alert')
@endsection
