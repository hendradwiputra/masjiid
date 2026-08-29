@props([
'createdBy' => null,
'createdAt' => null,
'updatedBy' => null,
'updatedAt' => null,
'bgColor' => 'blue-50',
'icon' => 'heroicon-o-clock', // change if you use another icon
'label' => 'Updated by:',
])

@if($createdBy || $createdAt || $updatedBy || $updatedAt)
<div {{ $attributes->merge(['class' => "bg-white border border-gray-200 rounded-lg p-2 gap-1"]) }}>

    <div class="flex items-center gap-1">
        <x-dynamic-component :component="$icon" class="w-5 h-5 text-gray-600 flex-shrink-0 mt-0.5" />
        <p class="text-xs font-bold text-left text-gray-600">Activity Log:</p>
    </div>

    <div class="text-left text-xs text-gray-600 space-y-0.5 ml-6">
        {{-- Created --}}
        @if($createdBy || $createdAt)
        <p>
            Created by:
            {{ $createdBy ?? '—' }}
            @if($createdAt)
            , {{ \Carbon\Carbon::parse($createdAt)->diffForHumans() }}
            @endif
        </p>
        @endif

        {{-- Updated --}}
        @if($updatedBy || $updatedAt)
        <p>
            {{ $label }}
            {{ $updatedBy ?? '—' }}
            @if($updatedAt)
            , {{ \Carbon\Carbon::parse($updatedAt)->diffForHumans() }}
            @endif
        </p>
        @endif
    </div>
</div>
@endif