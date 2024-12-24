<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $title ?? 'Dashboard' }}</h1>

                <!-- Breadcrumbs -->
                <div class="flex items-center text-sm text-gray-500 mt-1">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                    @if (isset($breadcrumbs))
                        @foreach ($breadcrumbs as $label => $url)
                            <svg class="h-4 w-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            @if (!$loop->last)
                                <a href="{{ $url }}" class="hover:text-blue-600">{{ $label }}</a>
                            @else
                                <span>{{ $label }}</span>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="flex items-center space-x-4">
                @if (isset($actions))
                    {{ $actions }}
                @endif
            </div>
        </div>
    </div>
</header>
