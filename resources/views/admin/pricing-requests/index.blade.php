@extends('admin.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Pricing Requests</h1>
                <p class="mt-2 text-sm text-gray-700">Manage and track all pricing requests.</p>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                ID</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Plan</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($requests as $request)
                            <tr class="hover:bg-gray-50">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ $request->id }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $request->name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $request->pricing->name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span
                                        class="inline-flex rounded-full px-2 py-1 text-xs font-semibold 
                                        {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $request->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $request->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $request->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $request->created_at->format('M d, Y') }}
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="{{ route('admin.pricing-requests.show', $request) }}"
                                        class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-8 text-sm text-gray-500 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span class="mt-2">No pricing requests found</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($requests->hasPages())
            <div class="mt-6">
                {{ $requests->links() }}
            </div>
        @endif
    </div>
@endsection
