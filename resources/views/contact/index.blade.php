@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#3B4BA6]/5 py-16">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900">Get in touch</h2>
                <p class="mt-4 text-xl text-gray-600">Have any questions? We'd love to hear from you.</p>
                <div class="w-20 h-1 bg-[#3B4BA6] mx-auto rounded-full mt-4"></div>
            </div>

            <!-- Contact Form Card -->
            <div class="bg-white rounded-2xl shadow-sm p-8 md:p-10 mb-16">
                @if (session('success'))
                    <div
                        class="mb-8 bg-green-50 border border-green-200 text-green-600 px-6 py-4 rounded-xl flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Contact Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-[#3B4BA6]/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#3B4BA6]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Phone</p>
                            <p class="text-lg font-medium text-gray-900">+260974323234</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-[#3B4BA6]/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#3B4BA6]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="text-lg font-medium text-gray-900">clivetlungu@gmail.com</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors duration-200"
                            placeholder="Enter your name" required value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors duration-200"
                            placeholder="Enter your email" required value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Field -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone (optional)</label>
                        <input type="tel" name="phone" id="phone"
                            class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors duration-200"
                            placeholder="Enter your phone number" value="{{ old('phone') }}">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject Field -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" name="subject" id="subject"
                            class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors duration-200"
                            placeholder="Enter subject" value="{{ old('subject') }}">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message Field -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" id="message" rows="6"
                            class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors duration-200 resize-none"
                            placeholder="Enter your message" required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
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
        </div>
    </div>
@endsection
