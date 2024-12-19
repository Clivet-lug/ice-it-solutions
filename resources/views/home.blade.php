@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="text-center">
                <h1 class="text-6xl font-bold text-blue-600 mb-4">FREE to DO MORE</h1>
                <p class="text-xl text-gray-600 mb-8">
                    Get some time to do more with your life, outsource your work today
                </p>
                <a href="#" class="bg-blue-600 text-white px-8 py-3 rounded-md text-lg hover:bg-blue-700">
                    GET STARTED
                </a>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Document Formatting -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Document formatting</h3>
                <p class="text-gray-600">
                    Have any document typed out in a format of your choosing.
                    You may send us a word document, pdf, or a hand written picture.
                </p>
            </div>

            <!-- Present like a Pro -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Present like a Pro</h3>
                <p class="text-gray-600">
                    Have professionally redesigned Presentations designed to capture your audience.
                </p>
            </div>

            <!-- Create a Website -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Create a Website</h3>
                <p class="text-gray-600">
                    Work with a UI/UX designer and have a beautiful website tailor made to suit your needs.
                </p>
            </div>
        </div>
    </div>
@endsection
