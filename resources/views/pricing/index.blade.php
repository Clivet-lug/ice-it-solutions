@extends('layouts.app')

@section('content')
    <div class="bg-[#3B4BA6]/5 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Enhanced Header -->
            <div class="text-center">
                <h2 class="text-4xl font-bold text-gray-900 sm:text-5xl">
                    Pricing Plans
                </h2>
                <p class="mt-4 text-xl text-gray-600">
                    Choose the perfect plan for your needs
                </p>
                <div class="w-20 h-1 bg-[#3B4BA6] mx-auto rounded-full mt-4"></div>
            </div>

            <!-- Pricing Categories -->
            <div x-data="{ activeCategory: 'all' }">
                <!-- Enhanced Filter Buttons -->
                <div class="mt-12">
                    <div class="flex justify-center flex-wrap gap-4">
                        <button @click="activeCategory = 'all'"
                            :class="activeCategory === 'all'
                                ?
                                'bg-[#3B4BA6] text-white ring-2 ring-[#3B4BA6] ring-offset-2' :
                                'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'"
                            class="px-6 py-2.5 text-sm font-medium rounded-full transition-all duration-300 shadow-sm group">
                            All Services
                            <span class="ml-2 px-2 py-0.5 bg-white/20 rounded-full text-xs">
                                {{ $counts['all'] ?? 0 }}
                            </span>
                        </button>
                        <button @click="activeCategory = 'website'"
                            :class="activeCategory === 'website'
                                ?
                                'bg-[#3B4BA6] text-white ring-2 ring-[#3B4BA6] ring-offset-2' :
                                'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'"
                            class="px-6 py-2.5 text-sm font-medium rounded-full transition-all duration-300 shadow-sm group">
                            Website Development
                            <span class="ml-2 px-2 py-0.5 bg-white/20 rounded-full text-xs">
                                {{ $counts['website'] ?? 0 }}
                            </span>
                        </button>
                        <button @click="activeCategory = 'document'"
                            :class="activeCategory === 'document'
                                ?
                                'bg-[#3B4BA6] text-white ring-2 ring-[#3B4BA6] ring-offset-2' :
                                'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'"
                            class="px-6 py-2.5 text-sm font-medium rounded-full transition-all duration-300 shadow-sm group">
                            Document Formatting
                            <span class="ml-2 px-2 py-0.5 bg-white/20 rounded-full text-xs">
                                {{ $counts['document'] ?? 0 }}
                            </span>
                        </button>
                        <button @click="activeCategory = 'presentation'"
                            :class="activeCategory === 'presentation'
                                ?
                                'bg-[#3B4BA6] text-white ring-2 ring-[#3B4BA6] ring-offset-2' :
                                'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'"
                            class="px-6 py-2.5 text-sm font-medium rounded-full transition-all duration-300 shadow-sm group">
                            Presentations
                            <span class="ml-2 px-2 py-0.5 bg-white/20 rounded-full text-xs">
                                {{ $counts['presentation'] ?? 0 }}
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Enhanced Pricing Cards -->
                <div class="mt-12 grid gap-8 lg:grid-cols-3">
                    @forelse ($pricings as $plan)
                        <div x-show="activeCategory === 'all' || activeCategory === '{{ strtolower($plan->type) }}'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="relative flex flex-col rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden hover:border-[#3B4BA6]/30 hover:scale-105 bg-white cursor-pointer"
                            x-cloak>

                            @if ($plan->is_featured)
                                <div class="absolute top-5 right-5">
                                    <span
                                        class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium bg-[#3B4BA6] text-white shadow-sm">
                                        Most Popular
                                    </span>
                                </div>
                            @endif

                            <div class="p-8">
                                <!-- Enhanced Plan Icon -->
                                <div
                                    class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-[#3B4BA6]/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    @if (strtolower($plan->type) === 'website')
                                        <svg class="w-8 h-8 text-[#3B4BA6]" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                    @elseif(strtolower($plan->type) === 'document')
                                        <svg class="w-8 h-8 text-[#3B4BA6]" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    @else
                                        <svg class="w-8 h-8 text-[#3B4BA6]" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                        </svg>
                                    @endif
                                </div>

                                <!-- Enhanced Typography -->
                                <h3 class="text-2xl font-bold text-center text-gray-900 mb-2">{{ $plan->name }}</h3>
                                <p class="text-sm text-center text-gray-500 mb-6">{{ $plan->type }}</p>

                                <!-- Enhanced Price Display -->
                                <div class="text-center mb-8">
                                    <span class="text-5xl font-bold text-[#3B4BA6]">
                                        K{{ number_format($plan->price, 2) }}
                                    </span>
                                </div>

                                <!-- Enhanced Features List -->
                                <ul class="space-y-4 mb-8">
                                    @if (is_array($plan->features))
                                        @foreach ($plan->features as $feature)
                                            <li class="flex items-start space-x-3">
                                                <div class="flex-shrink-0 w-5 h-5 mt-1">
                                                    <div
                                                        class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center">
                                                        <svg class="w-3 h-3 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <span class="text-gray-600">{{ $feature }}</span>
                                            </li>
                                        @endforeach
                                    @elseif(is_string($plan->features))
                                        @foreach (json_decode($plan->features, true) ?? [] as $feature)
                                            <li class="flex items-start space-x-3">
                                                <div class="flex-shrink-0 w-5 h-5 mt-1">
                                                    <div
                                                        class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center">
                                                        <svg class="w-3 h-3 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <span class="text-gray-600">{{ $feature }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            <!-- Enhanced Action Button -->
                            <div class="p-8 bg-gray-50 border-t border-gray-100">
                                <a href="{{ route('pricing.request', $plan) }}"
                                    class="block w-full py-3 px-6 text-center font-medium rounded-xl transition-all duration-300 transform hover:-translate-y-0.5
    {{ $plan->is_featured ? 'bg-[#3B4BA6] text-white hover:bg-[#2D3A8C]' : 'bg-white text-[#3B4BA6] border border-[#3B4BA6] hover:bg-[#3B4BA6] hover:text-white' }}">
                                    {{ $plan->button_text ?? 'Get Started' }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 bg-white rounded-2xl shadow-sm">
                            <p class="text-gray-500 text-lg">No pricing plans available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Enhanced FAQ Section -->
            <div class="mt-24">
                <h3 class="text-3xl font-bold text-center text-gray-900 mb-12">Frequently Asked Questions</h3>
                <dl class="max-w-3xl mx-auto space-y-8">
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <dt class="text-lg font-semibold text-gray-900">Do you offer custom solutions?</dt>
                        <dd class="mt-3 text-gray-600">Yes, we understand that every project is unique. Contact us for
                            custom pricing based on your specific needs.</dd>
                    </div>
                    <!-- Add more FAQs here -->
                </dl>
            </div>
        </div>

    </div>
    <!-- Contact Support Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Need More Information?</h3>
            <p class="text-gray-600 mb-6">Our team is here to answer any questions you might have about this
                service</p>
            <a href="{{ route('contact') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                Contact Support
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
        </div>
    </div>
@endsection
