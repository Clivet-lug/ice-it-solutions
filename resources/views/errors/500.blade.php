@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4">
        <div class="max-w-lg w-full bg-white rounded-lg shadow-lg p-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Oops!</h1>
            <p class="text-xl text-gray-600 mb-8">Something went wrong. Please try again later.</p>
            <a href="{{ url('/') }}"
                class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                Return Home
            </a>
        </div>
    </div>
@endsection
