@extends('admin.layouts.app')
@include('partials._alerts')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h1 class="text-xl sm:text-2xl font-semibold">Pricing Plans</h1>
            <a href="{{ route('admin.pricing.create') }}"
                class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-center">
                Add New Plan
            </a>
        </div>

        <!-- Pricing Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type</th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price</th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Features</th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pricings as $pricing)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">{{ $pricing->name }}</div>
                                        @if ($pricing->is_featured)
                                            <span
                                                class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Featured
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ ucfirst($pricing->type) }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    K{{ number_format($pricing->price, 2) }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-900">
                                    <div class="max-w-xs overflow-hidden">
                                        @php
                                            $features = json_decode($pricing->features);
                                            $displayFeatures = array_slice($features, 0, 2);
                                        @endphp
                                        @foreach ($displayFeatures as $feature)
                                            <div class="truncate">• {{ $feature }}</div>
                                        @endforeach
                                        @if (count($features) > 2)
                                            <div class="text-gray-500 text-xs">+{{ count($features) - 2 }} more</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs rounded-full 
                                        {{ $pricing->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $pricing->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                                        <a href="{{ route('admin.pricing.edit', $pricing) }}"
                                            class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.pricing.destroy', $pricing) }}" method="POST"
                                            class="inline-flex"
                                            onsubmit="return confirm('Are you sure you want to delete this pricing plan?');">
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
                                <td colspan="6" class="px-4 sm:px-6 py-4 text-center text-gray-500">
                                    No pricing plans found.
                                    <a href="{{ route('admin.pricing.create') }}"
                                        class="text-blue-600 hover:text-blue-900">
                                        Add your first plan
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (isset($pricings) && $pricings->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t">
                    {{ $pricings->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
