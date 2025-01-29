@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Manage Services</h1>
            <a href="{{ route('admin.services.create') }}"
                class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-center">
                Add New Service
            </a>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <form action="{{ route('admin.services.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search services..."
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                @include('partials.admin._status-filter')

                <button type="submit"
                    class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>

        <!-- Services Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Service
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($services as $service)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($service->image)
                                            <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
                                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}"
                                                    class="h-8 w-8 sm:h-10 sm:w-10 rounded-full object-cover">
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $service->name }}</div>
                                            <div class="text-xs sm:text-sm text-gray-500">
                                                {{ Str::limit($service->short_description, 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">K{{ number_format($service->price, 2) }}</div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                                        <a href="{{ route('admin.services.edit', $service) }}"
                                            class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form id="delete-form-{{ $service->id }}"
                                            action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                onclick="confirmDelete('delete-form-{{ $service->id }}')"
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
                                <td colspan="4" class="px-4 sm:px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-6">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <span class="text-gray-500">No services found.</span>
                                        <a href="{{ route('admin.services.create') }}"
                                            class="mt-2 text-blue-600 hover:text-blue-800">
                                            Add your first service
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>
@endsection
