@extends('admin.layouts.app')

@section('header', 'Service Requests')

@section('content')
    <div class="bg-white shadow rounded-lg">
        <div class="flex items-center justify-between p-6 border-b">
            <h2 class="text-xl font-semibold">All Requests</h2>

            <div class="flex gap-4">
                <select name="status" class="rounded-md border-gray-300" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($requests as $request)
                        <tr>
                            <td class="px-6 py-4">#{{ $request->id }}</td>
                            <td class="px-6 py-4">{{ $request->service->name }}</td>
                            <td class="px-6 py-4">
                                <div>{{ $request->name }}</div>
                                <div class="text-sm text-gray-500">{{ $request->email }}</div>
                            </td>
                            <td class="px-6 py-4">
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
                            <td class="px-6 py-4">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.requests.show', $request) }}"
                                    class="text-blue-600 hover:text-blue-900">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4">
            {{ $requests->links() }}
        </div>
    </div>
@endsection
