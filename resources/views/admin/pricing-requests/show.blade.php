@extends('admin.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Pricing Request Details</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Request #{{ $request->id }}</p>
                </div>
                <a href="{{ route('admin.pricing-requests.index') }}"
                    class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to List
                </a>
            </div>

            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $request->name }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $request->email }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Selected Plan</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $request->pricing->name }} (K{{ number_format($request->pricing->price, 2) }})
                        </dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Current Status</dt>
                        <dd class="mt-1">
                            <span
                                class="inline-flex rounded-full px-2 py-1 text-xs font-semibold 
                                {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $request->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $request->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $request->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                            </span>
                        </dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Date Submitted</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $request->created_at->format('M d, Y H:i') }}</dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Project Description</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $request->description }}</dd>
                    </div>

                    <div class="sm:col-span-2 pt-4 border-t">
                        <form action="{{ route('admin.pricing-requests.update-status', $request) }}" method="POST"
                            class="space-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Update Status</label>
                                <select name="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="in_progress" {{ $request->status === 'in_progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>
                                    <option value="completed" {{ $request->status === 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                    <option value="cancelled" {{ $request->status === 'cancelled' ? 'selected' : '' }}>
                                        Cancelled
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Admin Notes</label>
                                <textarea name="admin_notes" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Add any internal notes here...">{{ $request->admin_notes }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Update Request
                                </button>
                            </div>
                        </form>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
