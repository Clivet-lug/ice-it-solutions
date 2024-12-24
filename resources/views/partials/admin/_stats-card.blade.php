<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center">
        <div class="p-3 rounded-full {{ $bgColor ?? 'bg-blue-100' }} {{ $textColor ?? 'text-blue-600' }}">
            {{ $icon }}
        </div>
        <div class="ml-4">
            <h2 class="text-gray-600 text-sm font-medium">{{ $title }}</h2>
            <p class="text-2xl font-semibold text-gray-900">{{ $value }}</p>
            @if (isset($change))
                <p class="text-sm {{ $changeColor ?? 'text-green-600' }}">
                    {{ $change }}
                </p>
            @endif
        </div>
    </div>
    @if (isset($link))
        <div class="mt-4">
            <a href="{{ $link }}" class="text-sm text-blue-600 hover:text-blue-800">View details →</a>
        </div>
    @endif
</div>
