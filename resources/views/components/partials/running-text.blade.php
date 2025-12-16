@props([
'tickerText' => '',
'appSetting' => null,
])

@php
$rawSpeed = $appSetting['ticker_speed'] ?? 60;
$direction = $appSetting['ticker_direction'] ?? 'horizontal';

// Vertical = 3× faster → feels natural
$speed = ($direction === 'vertical') ? max(8, $rawSpeed / 3) : $rawSpeed;

// Split announcements by • separator
$announcements = array_filter(array_map('trim', explode('•', $tickerText)));
$hasMultiple = count($announcements) > 1;
@endphp

<div class="relative overflow-hidden bg-gradient-to-l from-gray-950 to-gray-800 text-stone-100 z-50 mx-0"
    style="height: 68px; --speed: {{ $speed }}s" x-data="{ direction: '{{ $direction }}' }"
    :class="{ 'vertical-mode': direction === 'vertical' }">

    <div class="running-text-content h-full flex items-center">
        @if($direction === 'horizontal')
        <!-- HORIZONTAL: Single line scroll -->
        <div class="horizontal-text">
            {{ $tickerText }}
        </div>
        @else
        <!-- VERTICAL: Multi-line + Wrapping -->
        <div class="vertical-list">
            @foreach($announcements as $ann)
            <div class="vertical-item">
                <div class="wrapped-text">{{ $ann }}</div>
            </div>
            @endforeach

            <!-- Duplicate for seamless infinite loop -->
            @if($hasMultiple)
            @foreach($announcements as $ann)
            <div class="vertical-item">
                <div class="wrapped-text">{{ $ann }}</div>
            </div>
            @endforeach
            @endif
        </div>
        @endif
    </div>
</div>

<style>
    /* HORIZONTAL MODE */
    .horizontal-text {
        display: inline-block;
        white-space: nowrap;
        /* Start from right */
        padding-left: 100%;
        font-size: clamp(3rem, 4vw, 4rem);
        font-weight: 700;
        animation: scroll-left var(--speed, 60s) linear infinite;
    }

    @keyframes scroll-left {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    /* VERTICAL MODE */
    .vertical-mode {
        display: flex;
        align-items: center;
        justify-content: start;
    }

    .vertical-list {
        display: flex;
        flex-direction: column;
        animation: scroll-up var(--speed, 60s) linear infinite;
        /* Start below the bar */
        width: 100%;
    }

    .vertical-item {
        padding: 8px 10px;
        text-align: left;
    }

    .wrapped-text {
        max-width: 100vw;
        /* Force wrap for long text */
        white-space: normal;
        /* Allow wrapping */
        word-wrap: break-word;
        font-size: clamp(2rem, 4.5vw, 3.8rem);
        font-weight: 700;
        line-height: 1.3;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
    }

    @keyframes scroll-up {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-50%);
        }

        /* 50% because we duplicated the list */
    }
</style>