@extends('layouts.app')

@section('title', 'Contact Details')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Contact Details</h2>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.contact.list') }}" class="text-gray-600 hover:text-gray-900">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="px-6 py-4">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $contact->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $contact->email }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $contact->phone ?? 'Not provided' }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $contact->status === 'new'
                                ? 'bg-green-100 text-green-800'
                                : ($contact->status === 'read'
                                    ? 'bg-blue-100 text-blue-800'
                                    : 'bg-gray-100 text-gray-800') }}">
                                {{ $contact->status_label }}
                            </span>
                        </dd>
                    </div>

                    <div class="col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Subject</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $contact->subject ?? 'No subject' }}</dd>
                    </div>

                    <div class="col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Message</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $contact->message }}</dd>
                    </div>

                    <!-- Admin Notes Form -->
                    <div class="col-span-2 mt-6">
                        <form action="{{ route('admin.contact.update-status', $contact) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="space-y-4">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Update
                                        Status</label>
                                    <select name="status" id="status"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="new" {{ $contact->status === 'new' ? 'selected' : '' }}>New
                                        </option>
                                        <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read
                                        </option>
                                        <option value="responded" {{ $contact->status === 'responded' ? 'selected' : '' }}>
                                            Responded</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="admin_notes" class="block text-sm font-medium text-gray-700">Admin
                                        Notes</label>
                                    <textarea name="admin_notes" id="admin_notes" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $contact->admin_notes }}</textarea>
                                </div>

                                <div>
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                        Update Contact
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
