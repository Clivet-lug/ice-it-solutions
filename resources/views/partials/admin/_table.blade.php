<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @foreach ($columns as $column)
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            @if (isset($column['sortable']) && $column['sortable'])
                                <a href="{{ request()->fullUrlWithQuery(['sort' => $column['key'], 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}"
                                    class="flex items-center space-x-1 hover:text-gray-700">
                                    <span>{{ $column['label'] }}</span>
                                    @if (request('sort') === $column['key'])
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if (request('direction') === 'asc')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 15l7-7 7 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            @endif
                                        </svg>
                                    @endif
                                </a>
                            @else
                                {{ $column['label'] }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($items as $item)
                    <tr class="hover:bg-gray-50">
                        @foreach ($columns as $column)
                            <td class="px-6 py-4 whitespace-nowrap {{ $column['class'] ?? '' }}">
                                @if (isset($column['render']))
                                    {!! $column['render']($item) !!}
                                @else
                                    {{ data_get($item, $column['key']) }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) }}" class="px-6 py-4 text-center text-gray-500">
                            {{ $emptyMessage ?? 'No items found.' }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (method_exists($items, 'links'))
        <div class="px-6 py-4 border-t">
            {{ $items->links() }}
        </div>
    @endif
</div>
