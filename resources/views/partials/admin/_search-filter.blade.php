<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form action="{{ $route }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search -->
        <div class="col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="{{ $searchPlaceholder ?? 'Search...' }}"
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <!-- Filters -->
        @if (isset($filters))
            {{ $filters }}
        @endif

        <!-- Date Range -->
        <div class="flex space-x-2">
            <input type="date" name="from_date" value="{{ request('from_date') }}"
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            <input type="date" name="to_date" value="{{ request('to_date') }}"
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <!-- Actions -->
        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Filter
            </button>
            <a href="{{ $route }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200">
                Reset
            </a>
        </div>
    </form>
</div>
