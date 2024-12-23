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
            <!-- Move x-data to a parent div that contains both categories and cards -->
            <div x-data="{ activeCategory: 'all' }">
                <!-- Pricing Categories -->
                <div class="mt-12">
                    <div class="flex justify-center space-x-4">
                        <button @click="activeCategory = 'all'"
                            :class="activeCategory === 'all' ? 'bg-blue-100 text-blue-600' :
                                'text-gray-600 hover:bg-gray-100'"
                            class="px-4 py-2 text-sm font-medium rounded-md transition-colors">
                            All Services
                            <span class="ml-2 px-2 py-0.5 bg-gray-100 rounded-full text-xs">
                                {{ $counts['all'] ?? 0 }}
                            </span>
                        </button>
                        <button @click="activeCategory = 'website'"
                            :class="activeCategory === 'website' ? 'bg-blue-100 text-blue-600' :
                                'text-gray-600 hover:bg-gray-100'"
                            class="px-4 py-2 text-sm font-medium rounded-md transition-colors">
                            Website Development
                            <span class="ml-2 px-2 py-0.5 bg-gray-100 rounded-full text-xs">
                                {{ $counts['website'] ?? 0 }}
                            </span>
                        </button>
                        <button @click="activeCategory = 'document'"
                            :class="activeCategory === 'document' ? 'bg-blue-100 text-blue-600' :
                                'text-gray-600 hover:bg-gray-100'"
                            class="px-4 py-2 text-sm font-medium rounded-md transition-colors">
                            Document Formatting
                            <span class="ml-2 px-2 py-0.5 bg-gray-100 rounded-full text-xs">
                                {{ $counts['document'] ?? 0 }}
                            </span>
                        </button>
                        <button @click="activeCategory = 'presentation'"
                            :class="activeCategory === 'presentation' ? 'bg-blue-100 text-blue-600' :
                                'text-gray-600 hover:bg-gray-100'"
                            class="px-4 py-2 text-sm font-medium rounded-md transition-colors">
                            Presentations
                            <span class="ml-2 px-2 py-0.5 bg-gray-100 rounded-full text-xs">
                                {{ $counts['presentation'] ?? 0 }}
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Pricing Cards -->
                <div class="mt-12 grid gap-8 lg:grid-cols-3">
                    @forelse ($pricings as $plan)
                        <div x-show="activeCategory === 'all' || activeCategory === '{{ strtolower($plan->type) }}'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            class="relative flex flex-col rounded-2xl border border-gray-200 shadow-sm" x-cloak>

                            @if ($plan->is_featured)
                                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                                    <span
                                        class="inline-flex rounded-full bg-blue-600 px-4 py-1 text-sm font-semibold text-white">
                                        Most Popular
                                    </span>
                                </div>
                            @endif

                            <div class="p-6">
                                <!-- Plan Icon -->
                                <div
                                    class="w-12 h-12 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                                    @if (strtolower($plan->type) === 'website')
                                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                    @elseif(strtolower($plan->type) === 'document')
                                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                        </svg>
                                    @endif
                                </div>

                                <h3 class="text-lg font-semibold text-center text-gray-900">{{ $plan->name }}</h3>
                                <p class="mt-2 text-sm text-center text-gray-500">{{ $plan->type }}</p>

                                <!-- Price Display -->
                                <p class="mt-4 text-center">
                                    <span class="text-4xl font-bold tracking-tight text-gray-900">
                                        K{{ number_format($plan->price, 2) }}
                                    </span>
                                </p>

                                <!-- Features List -->
                                <ul class="mt-6 space-y-4">
                                    @if (is_array($plan->features))
                                        @foreach ($plan->features as $feature)
                                            <li class="flex items-start">
                                                <span class="flex-shrink-0 text-green-500 mr-2">✓</span>
                                                <span class="text-gray-600">{{ $feature }}</span>
                                            </li>
                                        @endforeach
                                    @elseif(is_string($plan->features))
                                        @foreach (json_decode($plan->features, true) ?? [] as $feature)
                                            <li class="flex items-start">
                                                <span class="flex-shrink-0 text-green-500 mr-2">✓</span>
                                                <span class="text-gray-600">{{ $feature }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            <!-- Action Button -->
                            <div class="flex flex-1 flex-col justify-end p-6 border-t border-gray-200 bg-gray-50">
                                <a href="{{ route('contact') }}"
                                    class="block w-full rounded-md py-2 px-3 text-center text-sm font-semibold transition-colors
                        {{ $plan->is_featured
                            ? 'bg-blue-600 text-white hover:bg-blue-700'
                            : 'bg-white text-blue-600 border border-blue-600 hover:bg-blue-50' }}">
                                    {{ $plan->button_text ?? 'Get Started' }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <p class="text-gray-500 text-lg">No pricing plans available at the moment.</p>
                        </div>
                    @endforelse
                </div>
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
