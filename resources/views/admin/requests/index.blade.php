@extends('admin.layouts.app')
@include('partials._alerts')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-900">Service Requests</h1>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="text-sm text-gray-500">Total Requests</div>
                <div class="text-2xl font-bold">{{ $statistics['total'] }}</div>
            </div>
            <div class="bg-yellow-50 rounded-lg shadow p-4">
                <div class="text-sm text-yellow-700">Pending</div>
                <div class="text-2xl font-bold text-yellow-600">{{ $statistics['pending'] }}</div>
            </div>
            <div class="bg-blue-50 rounded-lg shadow p-4">
                <div class="text-sm text-blue-700">Processing</div>
                <div class="text-2xl font-bold text-blue-600">{{ $statistics['processing'] }}</div>
            </div>
            <div class="bg-green-50 rounded-lg shadow p-4">
                <div class="text-sm text-green-700">Completed</div>
                <div class="text-2xl font-bold text-green-600">{{ $statistics['completed'] }}</div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <form action="{{ route('admin.requests.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Requests Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($requests as $request)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $request->service->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $request->name }}</div>
                                <div class="text-sm text-gray-500">{{ $request->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $request->status === 'completed'
                                    ? 'bg-green-100 text-green-800'
                                    : ($request->status === 'processing'
                                        ? 'bg-blue-100 text-blue-800'
                                        : ($request->status === 'cancelled'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-yellow-100 text-yellow-800')) }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $request->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.requests.show', $request) }}"
                                        class="text-blue-600 hover:text-blue-900">View</a>
                                    <form action="{{ route('admin.requests.destroy', $request) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this request?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No requests found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    </div>
@endsection
