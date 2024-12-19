@extends('layouts.app')

@section('content')
    {{-- <!-- Hero Section -->
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
    </div> --}}

    <!-- Hero Section with Background Image -->
    <div class="relative h-screen">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-bg.jpg') }}" alt="Hero Background" class="w-full h-full object-cover">
            <!-- Overlay to ensure text is readable -->
            <div class="absolute inset-0 bg-black opacity-30"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 h-full">
            <div class="flex flex-col justify-center h-full">
                <h1 class="text-6xl font-bold text-white mb-4">FREE to DO MORE</h1>
                <p class="text-xl text-white mb-8">
                    Get some time to do more with your life, outsource your work today
                </p>
                <div>
                    <a href="#"
                        class="inline-block bg-blue-600 text-white px-8 py-3 rounded-md text-lg hover:bg-blue-700">
                        GET STARTED
                    </a>
                </div>
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

    <!-- Get In Touch Section -->
<div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <!-- Left Side Content -->
            <div class="w-full md:w-1/2 space-y-8 mb-8 md:mb-0">
                <!-- Logo Squares -->
                <div class="flex gap-2 mb-4">
                    <div class="w-4 h-4 border-2 border-blue-600"></div>
                    <div class="w-4 h-4 border-2 border-blue-600"></div>
                    <div class="w-4 h-4 border-2 border-blue-600"></div>
                    <div class="w-4 h-4 border-2 border-pink-400"></div>
                </div>

                <h2 class="text-4xl font-bold text-blue-600">Get In touch</h2>

                <!-- Contact Details -->
                <div class="space-y-6">
                    <!-- Speak to an agent -->
                    <div class="flex items-center gap-4">
                        <div class="text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-blue-600">Speak to an agent</p>
                            <p class="text-gray-600">250970983828</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center gap-4">
                        <div class="text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-blue-600">Email</p>
                            <p class="text-gray-600">iceitsol@gmail.com</p>
                        </div>
                    </div>

                    <!-- Visit our website -->
                    <div class="flex items-center gap-4">
                        <div class="text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-blue-600">Visit our web site</p>
                            <p class="text-gray-600">https://www.iceitsol.com</p>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="pt-6">
                        <p class="font-medium text-blue-600 mb-4">Follow us on social media</p>
                        <div class="flex gap-4">
                            <a href="#" class="text-green-500 hover:text-green-600">
                                <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="w-8 h-8">
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-700">
                                <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="w-8 h-8">
                            </a>
                            <a href="#" class="text-pink-600 hover:text-pink-700">
                                <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="w-8 h-8">
                            </a>
                            <a href="#" class="text-black hover:text-gray-800">
                                <img src="{{ asset('images/x-twitter.png') }}" alt="X (Twitter)" class="w-8 h-8">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side Circle Image -->
            <div class="w-full md:w-1/2 relative">
                <div class="aspect-square relative">
                    <!-- Circle mask with image -->
                    <div class="absolute inset-0 rounded-full overflow-hidden border-8 border-white shadow-lg">
                        <img src="{{ asset('images/contact-image.jpg') }}" alt="Contact" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
