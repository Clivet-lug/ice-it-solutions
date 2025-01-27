@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold text-gray-900">Pricing Requests</h1>
            </div>
        </div>

        <div class="mt-8 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">ID</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Plan</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Date</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($requests as $request)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-900">
                                            {{ $request->id }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $request->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $request->pricing->name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            <span
                                                class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 
                                        {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $request->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $request->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $request->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $request->created_at->format('M d, Y') }}
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('admin.pricing-requests.show', $request) }}"
                                                class="text-blue-600 hover:text-blue-900">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-3 py-4 text-sm text-gray-500 text-center">No requests
                                            found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            {{ $requests->links() }}
        </div>
    </div>
@endsection
