@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <!-- Header -->
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Contact Submission Details</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Submitted on
                    {{ $contact->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>

            <!-- Content -->
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $contact->name }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $contact->email }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $contact->phone ?? 'Not provided' }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <span
                                class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 
                            {{ $contact->status === 'new'
                                ? 'bg-green-100 text-green-800'
                                : ($contact->status === 'read'
                                    ? 'bg-blue-100 text-blue-800'
                                    : 'bg-gray-100 text-gray-800') }}">
                                {{ $contact->status_label }}
                            </span>
                        </dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Subject</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $contact->subject ?? 'No subject' }}</dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Message</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $contact->message }}</dd>
                    </div>

                    <!-- Update Status Form -->
                    <div class="sm:col-span-2">
                        <form action="{{ route('contact.update', $contact) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Update
                                        Status</label>
                                    <select name="status" id="status"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
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
                                    <textarea name="admin_notes" id="admin_notes" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ $contact->admin_notes }}</textarea>
                                </div>

                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>


                    <!-- Delete Button -->
                    <div class="sm:col-span-2">
                        <form action="{{ route('contact.destroy', $contact) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this contact submission?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Delete Submission
                            </button>
                        </form>
                    </div>

                </dl>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('contact.list') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                ← Back to List
            </a>
        </div>
    </div>
@endsection
