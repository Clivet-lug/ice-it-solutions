@extends('admin.layouts.app')

@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
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

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold">Recent Requests</h2>
        </div>
        <div class="p-6">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left">Service</th>
                        <th class="text-left">Client</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recent_requests as $request)
                        <tr>
                            <td class="py-2">{{ $request->service->name }}</td>
                            <td>{{ $request->name }}</td>
                            <td>
                                <span
                                    class="px-2 py-1 rounded-full text-xs 
                            {{ $request->status === 'pending'
                                ? 'bg-yellow-100 text-yellow-800'
                                : ($request->status === 'processing'
                                    ? 'bg-blue-100 text-blue-800'
                                    : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
