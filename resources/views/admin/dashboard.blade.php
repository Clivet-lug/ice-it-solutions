@extends('admin.layouts.app')

@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-500 text-sm">Total Services</div>
            <div class="text-3xl font-bold text-blue-600">{{ $stats['total_services'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-500 text-sm">Active Services</div>
            <div class="text-3xl font-bold text-green-600">{{ $stats['active_services'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-500 text-sm">Pending Requests</div>
            <div class="text-3xl font-bold text-yellow-600">{{ $stats['pending_requests'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-gray-500 text-sm">Total Requests</div>
            <div class="text-3xl font-bold text-purple-600">{{ $stats['total_requests'] }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold">Recent Requests</h2>
        </div>
        <div class="p-6 overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($recent_requests as $request)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $request->service->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $request->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $request->status === 'pending'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : ($request->status === 'processing'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $request->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
