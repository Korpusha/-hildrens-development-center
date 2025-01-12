@props([
    'options' => [],
    'emptyOption' => false,
    'emptyOptionText' => 'Select an option',
    'values' => [],
])

<select {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
    @if ($emptyOption)
        <option value="">{{ $emptyOptionText }}</option>
    @endif

    @foreach ($options as $value => $name)
        <option value="{{ $value }}" @if (in_array($value, $values)) selected @endif>
            {{ $name }}
        </option>
    @endforeach
</select>
