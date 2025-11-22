@props(['active' => false, 'label' => ''])

<span {{ $attributes->merge([
    'class' => 'inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded ' .
    ($active ? 'bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded' : 'bg-gray-100 text-gray-800
    border border-gray-300
    text-xs font-semibold px-2.5 py-1 rounded')
    ]) }}>
    @if($active)
    Published
    @else
    Draft
    @endif
    {{ $label }}
</span>