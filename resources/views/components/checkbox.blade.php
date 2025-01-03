@props(['disabled' => false])

<input type="checkbox" {!! $attributes->merge([
    'class' =>
        'rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
    'disabled' => $disabled,
]) !!}>
