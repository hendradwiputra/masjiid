@props([
'status' => false,
'activeText' => 'Active',
'inactiveText' => 'Inactive',
'activeColor' => 'green',
'inactiveColor' => 'yellow',
])

@php
$isActive = $status === true || !is_null($status);
$color = $isActive ? $activeColor : $inactiveColor;
$text = $isActive ? $activeText : $inactiveText;

$colorClasses = [
'green' => 'bg-green-100 text-green-800',
'yellow' => 'bg-yellow-100 text-yellow-800',
'red' => 'bg-red-100 text-red-800',
'blue' => 'bg-blue-100 text-blue-800',
'purple' => 'bg-purple-100 text-purple-800',
'gray' => 'bg-gray-100 text-gray-800',
];
@endphp

<span
    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colorClasses[$color] ?? 'bg-gray-100 text-gray-800' }}">
    {{ $text }}
</span>