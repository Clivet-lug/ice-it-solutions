@extends('admin.layouts.app')

@section('header', 'Request Details')

@section('content')
    <div class="bg-white shadow rounded-lg">
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold">Request #{{ $request->id }}</h2>
                <span
                    class="px-3 py-1 rounded-full text-sm 
                {{ $request->status === 'pending'
                    ? 'bg-yellow-100 text-yellow-800'
                    : ($request->status === 'processing'
                        ? 'bg-blue-100 text-blue-800'
                        : 'bg-green-100 text-green-800') }}">
                    {{ ucfirst($request->status) }}
                </span>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium">Client Information</h3>
                    <div class="mt-4 space-y-2">
                        <p><span class="font-medium">Name:</span> {{ $request->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $request->email }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium">Service Details</h3>
                    <div class="mt-4 space-y-2">
                        <p><span class="font-medium">Service:</span> {{ $request->service->name }}</p>
                        <p><span class="font-medium">Date:</span> {{ $request->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-medium">Requirements</h3>
                <p class="mt-2">{{ $request->requirements }}</p>
            </div>

            @if ($request->file_path)
                <div>
                    <h3 class="text-lg font-medium">Attachments</h3>
                    <a href="{{ Storage::url($request->file_path) }}"
                        class="mt-2 inline-flex items-center text-blue-600 hover:text-blue-900">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z">
                            </path>
                        </svg>
                        Download Attachment
                    </a>
                </div>
            @endif

            <form action="{{ route('admin.requests.update', $request) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Update Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300">
                            <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $request->status === 'processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="completed" {{ $request->status === 'completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Admin Notes</label>
                        <textarea name="admin_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300">{{ $request->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Update Request
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
