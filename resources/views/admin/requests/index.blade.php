@extends('admin.layouts.app')
@include('partials._alerts')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Service Requests</h1>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="text-sm text-gray-500">Total Requests</div>
                <div class="text-xl sm:text-2xl font-bold">{{ $statistics['total'] }}</div>
            </div>
            <div class="bg-yellow-50 rounded-lg shadow p-4">
                <div class="text-sm text-yellow-700">Pending</div>
                <div class="text-xl sm:text-2xl font-bold text-yellow-600">{{ $statistics['pending'] }}</div>
            </div>
            <div class="bg-blue-50 rounded-lg shadow p-4">
                <div class="text-sm text-blue-700">Processing</div>
                <div class="text-xl sm:text-2xl font-bold text-blue-600">{{ $statistics['processing'] }}</div>
            </div>
            <div class="bg-green-50 rounded-lg shadow p-4">
                <div class="text-sm text-green-700">Completed</div>
                <div class="text-xl sm:text-2xl font-bold text-green-600">{{ $statistics['completed'] }}</div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <form action="{{ route('admin.requests.index') }}" method="GET"
                class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-4 sm:gap-4">
                <div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name or email" class="w-full rounded-lg border-gray-300">
                </div>
                <div>
                    <select name="status" class="w-full rounded-lg border-gray-300">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing
                        </option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                        </option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                    </select>
                </div>
                <div>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="w-full rounded-lg border-gray-300" placeholder="Start Date">
                </div>
                <div class="flex gap-2">
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full rounded-lg border-gray-300" placeholder="End Date">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex-shrink-0">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Requests Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($requests as $request)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $request->service->name }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $request->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $request->email }}</div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $request->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $request->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $request->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->created_at->format('M d, Y H:i') }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                                        <a href="{{ route('admin.requests.show', $request) }}"
                                            class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </a>
                                        <form action="{{ route('admin.requests.destroy', $request) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this request?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 sm:px-6 py-4 text-center text-gray-500">
                                    No requests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    </div>
@endsection
