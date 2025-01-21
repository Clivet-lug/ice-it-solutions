@extends('layouts.app')

@section('content')
    <!-- Hero Section  -->
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
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Document Formatting -->
                <div class="bg-[#3B4BA6]/5 p-8 rounded-2xl hover:shadow-lg transition-all duration-300">
                    <!-- Icon -->
                    <div class="mb-6">
                        <svg class="w-10 h-10 text-[#3B4BA6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3">Document formatting</h3>
                    <p class="text-gray-600 mb-6">Have any document typed out in a format of your choosing.</p>

                    <a href="{{ route('services.show', 'document-formatting') }}"
                        class="text-[#3B4BA6] hover:text-[#2D3A8C] inline-flex items-center group">
                        Learn more
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Present like a Pro -->
                <div class="bg-[#3B4BA6]/5 p-8 rounded-2xl hover:shadow-lg transition-all duration-300">
                    <!-- Icon -->
                    <div class="mb-6">
                        <svg class="w-10 h-10 text-[#3B4BA6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3">Present like a Pro</h3>
                    <p class="text-gray-600 mb-6">Have professionally redesigned Presentations designed to capture your
                        audience.</p>

                    <a href="{{ route('services.show', 'presentation-design') }}"
                        class="text-[#3B4BA6] hover:text-[#2D3A8C] inline-flex items-center group">
                        Learn more
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Create a Website -->
                <div class="bg-[#3B4BA6]/5 p-8 rounded-2xl hover:shadow-lg transition-all duration-300">
                    <!-- Icon -->
                    <div class="mb-6">
                        <svg class="w-10 h-10 text-[#3B4BA6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3">Create a Website</h3>
                    <p class="text-gray-600 mb-6">Work with a UI/UX designer and have a beautiful website tailor made.</p>

                    <a href="{{ route('services.show', 'website-creation') }}"
                        class="text-[#3B4BA6] hover:text-[#2D3A8C] inline-flex items-center group">
                        Learn more
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Get In Touch Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <!-- Left Side Content -->
                <div class="w-full md:w-1/2 space-y-12">
                    <!-- Logo Squares - More minimalist version -->
                    <div class="flex gap-2">
                        <div class="w-3 h-3 bg-[#3B4BA6]/20 border border-[#3B4BA6]"></div>
                        <div class="w-3 h-3 bg-[#3B4BA6]/20 border border-[#3B4BA6]"></div>
                        <div class="w-3 h-3 bg-[#3B4BA6]/20 border border-[#3B4BA6]"></div>
                        <div class="w-3 h-3 bg-pink-100 border border-pink-300"></div>
                    </div>

                    <h2 class="text-4xl font-bold text-gray-900">Get In touch</h2>

                    <!-- Contact Details - Cleaner design -->
                    <div class="space-y-8">
                        <!-- Speak to an agent -->
                        <div class="flex items-center gap-3">
                            <div class="text-[#3B4BA6]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Speak to an agent</p>
                                <p class="text-gray-600">+260974323234</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-center gap-3">
                            <div class="text-[#3B4BA6]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Email</p>
                                <p class="text-gray-600">iceitsols@gmail.com</p>
                            </div>
                        </div>

                        <!-- Visit our website -->
                        <div class="flex items-center gap-3">
                            <div class="text-[#3B4BA6]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Visit our web site</p>
                                <p class="text-gray-600">https://www.iceitsol.com</p>
                            </div>
                        </div>

                        <!-- Social Media Section - More minimal design -->
                        <div class="pt-4">
                            <p class="text-sm font-medium text-gray-900 mb-4">Follow us on social media</p>
                            <div class="flex gap-4">
                                <!-- Social icons with uniform styling -->
                                <a href="#" class="text-gray-600 hover:text-[#25D366] transition-colors">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                        <!-- Keep WhatsApp SVG path -->
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-[#1877F2] transition-colors">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                        <!-- Keep Facebook SVG path -->
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-[#E4405F] transition-colors">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                        <!-- Keep Instagram SVG path -->
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-black transition-colors">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                        <!-- Keep Twitter/X SVG path -->
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side Circle Image - More modern styling -->
                <div class="w-full md:w-1/2">
                    <div class="aspect-square relative max-w-md mx-auto">
                        <div class="absolute inset-0 rounded-full overflow-hidden">
                            <img src="{{ asset('images/contact-image.webp') }}" alt="Contact"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
