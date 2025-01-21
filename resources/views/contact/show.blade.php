@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#3B4BA6]/5 py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900">Get in touch</h2>
                <p class="mt-4 text-xl text-gray-600">Let us help you with your project</p>
                <div class="w-20 h-1 bg-[#3B4BA6] mx-auto rounded-full mt-4"></div>
            </div>

            <!-- Contact Form Card -->
            <div class="bg-white rounded-2xl shadow-sm p-8 md:p-10">
                @if (session('success'))
                    <div
                        class="mb-8 bg-green-50 border border-green-200 text-green-600 px-6 py-4 rounded-xl flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                    @csrf
                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors duration-200"
                            placeholder="Enter your name" required>
                        @error('name')
                            <p class="text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors duration-200"
                            placeholder="Enter your email" required>
                        @error('email')
                            <p class="text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Message Field -->
                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" id="message" rows="6"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors duration-200 resize-none"
                            placeholder="Tell us about your project" required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-[#3B4BA6] text-white px-6 py-3.5 rounded-xl hover:bg-[#2D3A8C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3B4BA6] transition-colors duration-300 flex items-center justify-center space-x-2">
                        <span>Send Message</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Contact Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <!-- Phone Card -->
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm">
                    <div class="w-12 h-12 bg-[#3B4BA6]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-[#3B4BA6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Phone</h3>
                    <p class="text-gray-600 mt-2">+260 974 323 234</p>
                </div>

                <!-- Email Card -->
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm">
                    <div class="w-12 h-12 bg-[#3B4BA6]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-[#3B4BA6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Email</h3>
                    <p class="text-gray-600 mt-2 break-all">contact@iceitsolutions.com</p>
                </div>

                <!-- Location Card -->
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm">
                    <div class="w-12 h-12 bg-[#3B4BA6]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-[#3B4BA6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Location</h3>
                    <p class="text-gray-600 mt-2">Lusaka, Zambia</p>
                </div>
            </div>
        </div>
    </div>
@endsection
