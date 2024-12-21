@extends('layouts.app')

@section('content')
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Pricing Plans
                </h2>
                <p class="mt-4 text-xl text-gray-600">
                    Choose the perfect plan for your needs
                </p>
            </div>

            <!-- Pricing Categories -->
            <div class="mt-12">
                <div class="flex justify-center space-x-4">
                    <button class="px-4 py-2 text-sm font-medium rounded-md text-blue-600 bg-blue-100">
                        All Services
                    </button>
                    <button class="px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-100">
                        Website Development
                    </button>
                    <button class="px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-100">
                        Document Formatting
                    </button>
                    <button class="px-4 py-2 text-sm font-medium rounded-md text-gray-600 hover:bg-gray-100">
                        Presentations
                    </button>
                </div>
            </div>

            <!-- Pricing Cards -->
            <div class="mt-12 grid gap-8 lg:grid-cols-3">
                @foreach ($pricings as $plan)
                    <div
                        class="relative flex flex-col rounded-2xl border border-gray-200 shadow-sm {{ $plan->is_featured ? 'border-blue-600 shadow-blue-100' : '' }}">
                        @if ($plan->is_featured)
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                <span
                                    class="inline-flex rounded-full bg-blue-600 px-4 py-1 text-sm font-semibold text-white">
                                    Most Popular
                                </span>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $plan->name }}</h3>
                            <p class="mt-2 text-sm text-gray-500">{{ $plan->type }}</p>
                            <p class="mt-4">
                                <span class="text-4xl font-bold tracking-tight text-gray-900">${{ $plan->price }}</span>
                            </p>

                            <ul class="mt-6 space-y-4">
                                @foreach (json_decode($plan->features) as $feature)
                                    <li class="flex">
                                        <span class="text-green-500 mr-2">✓</span>
                                        <span class="text-gray-600">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="flex flex-1 flex-col justify-end p-6 border-t border-gray-200 bg-gray-50">
                            <a href="{{ route('contact') }}"
                                class="block w-full rounded-md py-2 px-3 text-center text-sm font-semibold {{ $plan->is_featured ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-white text-blue-600 border border-blue-600 hover:bg-blue-50' }}">
                                {{ $plan->button_text }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- FAQ Section -->
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-gray-900 text-center">Frequently Asked Questions</h3>
                <dl class="mt-8 space-y-6">
                    <div>
                        <dt class="text-lg font-semibold text-gray-900">Do you offer custom solutions?</dt>
                        <dd class="mt-2 text-gray-600">Yes, we understand that every project is unique. Contact us for
                            custom pricing based on your specific needs.</dd>
                    </div>
                    <!-- Add more FAQs -->
                </dl>
            </div>
        </div>
    </div>
@endsection
