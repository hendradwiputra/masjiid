@php
$label = $label ?? '';
$type = $type ?? 'text';
$name = $name ?? '';
$value = $value ?? '';
$placeholder = $placeholder ?? '';
$required = $required ?? false;
$error = $error ?? null;
@endphp

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-900 mb-2">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>

    @if($type === 'textarea')
    <textarea id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{
        $attributes->merge(['class' => 'text-sm w-full px-4 py-2 border ' . ($error ? 'border-red-500' : 'border-gray-300') . ' rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent']) }}
        rows="4"
    >{{ $value }}</textarea>

    @elseif($type === 'select')
    <select id="{{ $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(['class' =>
        'text-sm w-full px-4 py-2 border ' . ($error ? 'border-red-500' : 'border-gray-300') . ' rounded-lg
        focus:outline-none
        focus:ring-2 focus:ring-blue-500 focus:border-transparent']) }}
        >
        <option value="">{{ $placeholder ?: 'Select an option' }}</option>
        {{ $slot }}
    </select>

    @else
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }} {{ $attributes->merge(['class' => 'text-sm w-full px-4 py-2 border ' . ($error
    ?
    'border-red-500' : 'border-gray-300') . ' rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500
    focus:border-transparent']) }}
    />
    @endif

    @if($error)
    <p class="text-red-500 bg-red-50 p-2 rounded-md text-sm font-semibold mt-2">{{ $error }}</p>
    @endif
</div>