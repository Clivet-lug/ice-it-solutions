@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#3B4BA6]/5 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <!-- Header Section -->
                <div class="bg-[#3B4BA6] px-8 py-6 text-white">
                    <h2 class="text-2xl font-bold">Request {{ $pricing->name }}</h2>
                    <p class="mt-2 text-white/80">Complete the form below to get started</p>
                </div>

                <div class="p-8">
                    <!-- Plan Summary Card -->
                    <div class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $pricing->type }}</h3>
                                <p class="text-[#3B4BA6] text-lg font-semibold mt-1">
                                    K{{ number_format($pricing->price, 2) }}</p>
                            </div>
                            <span class="px-3 py-1 bg-[#3B4BA6]/10 text-[#3B4BA6] text-sm font-medium rounded-full">
                                Selected Plan
                            </span>
                        </div>

                        <!-- Features List -->
                        <div class="space-y-3">
                            @if (is_array($pricing->features))
                                @foreach ($pricing->features as $feature)
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-600">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Request Form -->
                    <form action="{{ route('pricing.submit-request') }}" method="POST" id="pricingRequestForm">
                        @csrf
                        <input type="hidden" name="pricing_id" value="{{ $pricing->id }}">

                        <div class="space-y-6">
                            <!-- Personal Details Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name"
                                        class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors"
                                        placeholder="Your full name" required>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email"
                                        class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors"
                                        placeholder="your@email.com" required>
                                </div>
                            </div>

                            <!-- Project Details -->
                            <div>
                                <label class="text-sm font-medium text-gray-700">Project Description</label>
                                <textarea name="description" rows="4"
                                    class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#3B4BA6] focus:ring focus:ring-[#3B4BA6]/20 transition-colors resize-none"
                                    placeholder="Please describe your project requirements and any specific needs..." required></textarea>
                                <p class="mt-2 text-sm text-gray-500">
                                    Be as detailed as possible to help us understand your needs better.
                                </p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full bg-[#3B4BA6] text-white px-6 py-3 rounded-xl hover:bg-[#2D3A8C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3B4BA6] transition-all duration-300 flex items-center justify-center">
                                Submit Request
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const form = document.getElementById('pricingRequestForm');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Submitting Request',
                    text: 'Please wait while we process your request...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Request Submitted!',
                                text: 'We will get back to you shortly.',
                                confirmButtonColor: '#3B4BA6'
                            }).then(() => {
                                window.location.href = document.referrer;
                            });
                        } else {
                            throw new Error(data.message || 'Something went wrong');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error.message || 'Something went wrong!',
                            confirmButtonColor: '#3B4BA6'
                        });
                    });
            });
        </script>
    @endpush
@endsection
