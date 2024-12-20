@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-8">Request {{ $service->name }}</h1>

                <form action="{{ route('services.submit-request') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">

                    <!-- Personal Details -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Name
                        </label>
                        <input type="text" name="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Email
                        </label>
                        <input type="email" name="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <!-- Project Details -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Project Description
                        </label>
                        <textarea name="description" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Attachments (if any)
                        </label>
                        <input type="file" name="attachments[]" multiple
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Submit Request
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
