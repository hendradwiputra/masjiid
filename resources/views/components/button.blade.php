@props([
'type' => 'button',
'variant' => 'primary',
'size' => 'md',
'icon' => null,
'iconPosition' => 'left',
'loading' => false,
'disabled' => false,
'href' => null,
'target' => '_self',
'wire' => null,
'wireClick' => null,
])

@php
// Size classes
$sizes = [
'xs' => 'px-2.5 py-1.5 text-xs',
'sm' => 'px-3 py-2 text-sm',
'md' => 'px-4 py-2.5 text-sm',
'lg' => 'px-5 py-3 text-base',
'xl' => 'px-6 py-3.5 text-base',
];

// Variant classes
$variants = [
'primary' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 text-white',
'secondary' => 'bg-slate-600 hover:bg-slate-700 focus:ring-slate-500 text-white',
'success' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500 text-white',
'danger' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white',
'warning' => 'bg-amber-500 hover:bg-amber-600 focus:ring-amber-400 text-white',
'info' => 'bg-cyan-600 hover:bg-cyan-700 focus:ring-cyan-500 text-white',
'dark' => 'bg-slate-800 hover:bg-slate-900 focus:ring-slate-700 text-white',
'light' => 'bg-slate-100 hover:bg-slate-200 focus:ring-slate-300 text-slate-700',
'outline-primary' => 'border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white',
'outline-secondary' => 'border border-slate-600 text-slate-600 hover:bg-slate-600 hover:text-white',
'outline-success' => 'border border-green-600 text-green-600 hover:bg-green-600 hover:text-white',
'outline-danger' => 'border border-red-600 text-red-600 hover:bg-red-600 hover:text-white',
'outline-warning' => 'border border-amber-500 text-amber-500 hover:bg-amber-500 hover:text-white',
'outline-light' => 'border border-slate-300 text-slate-700 hover:bg-slate-100',
'ghost-primary' => 'text-blue-600 hover:bg-blue-50',
'ghost-secondary' => 'text-slate-600 hover:text-slate-50 hover:bg-slate-500',
'ghost-danger' => 'text-red-600 hover:bg-red-50',
'ghost-dark' => 'text-slate-800 hover:bg-slate-100',
];

$iconComponent = 'heroicon-o-' . $icon;
$sizeClass = $sizes[$size] ?? $sizes['md'];
$variantClass = $variants[$variant] ?? $variants['primary'];
$disabledClass = ($disabled || $loading) ? 'opacity-50 cursor-not-allowed' : '';
$loadingClass = $loading ? 'relative !text-transparent' : '';
$baseClass = "inline-flex items-center justify-center gap-2 font-medium rounded-full transition-all duration-200
focus:outline-none focus:ring-2 focus:ring-offset-2 {$sizeClass} {$variantClass} {$disabledClass} {$loadingClass}";
@endphp

@if($href)
<a href="{{ $href }}" target="{{ $target }}" {{ $attributes->merge(['class' => $baseClass]) }}
    @if($disabled || $loading) onclick="return false;" @endif>
    @if($icon && $iconPosition === 'left')
    <x-dynamic-component :component="$iconComponent" class="w-4 h-4" />
    @endif

    {{ $slot }}

    @if($icon && $iconPosition === 'right')
    <x-dynamic-component :component="$iconComponent" class="w-4 h-4" />
    @endif

    @if($loading)
    <span class="absolute inset-0 flex items-center justify-center">
        <svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </span>
    @endif
</a>
@else
<button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClass]) }}
    @if($disabled || $loading) disabled @endif
    @if($wire) wire:{{ $wire }} @endif
    @if($wireClick) wire:click="{{ $wireClick }}" @endif>
    @if($icon && $iconPosition === 'left')
    <x-dynamic-component :component="$iconComponent" class="w-4 h-4" />
    @endif

    {{ $slot }}

    @if($icon && $iconPosition === 'right')
    <x-dynamic-component :component="$iconComponent" class="w-4 h-4" />
    @endif

    @if($loading)
    <span class="absolute inset-0 flex items-center justify-center">
        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    </span>
    @endif
</button>
@endif