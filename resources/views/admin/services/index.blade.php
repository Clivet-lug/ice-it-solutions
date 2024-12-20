@extends('admin.layouts.app')

@section('header')
    <div class="flex justify-between">
        <h2>Services</h2>
        <a href="{{ route('admin.services.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Service</a>
    </div>
@endsection

@section('content')
    <div class="bg-white shadow rounded-lg">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b">Name</th>
                    <th class="px-6 py-3 border-b">Price</th>
                    <th class="px-6 py-3 border-b">Status</th>
                    <th class="px-6 py-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td class="px-6 py-4">{{ $service->name }}</td>
                        <td class="px-6 py-4">${{ $service->price }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.services.edit', $service) }}" class="text-blue-600">Edit</a>
                            <form class="inline" method="POST" action="{{ route('admin.services.destroy', $service) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-4">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
