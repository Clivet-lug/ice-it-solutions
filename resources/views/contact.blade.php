@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-blue-600 mb-8">Contact Us</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="phone" class="block text-gray-700">Phone (optional)</label>
                <input type="tel" name="phone" id="phone"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="message" class="block text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Send Message
            </button>
        </form>
    </div>
@endsection
