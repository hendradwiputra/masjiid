<div class="h-screen bg-gradient-to-r from-gray-600 to-gray-800 text-white overflow-hidden flex">

    <!-- Left Side -->
    <div class="w-full lg:w-1/2 flex flex-col relative">

        <!-- Profile -->
        <div class="relative p-6 text-center">
            <div class="flex flex-col text-stone-200 text-xl text-shadow-lg">
                <h1 class="font-merriweather font-bold text-2xl lg:text-3xl md:leading-8 lg:mb-2 highlight-me"
                    id="name">
                </h1>
                <p class="text-sm lg:text-xl md:leading-5 lg:mb-2" id="address"></p>
                <p class="text-sm lg:text-xl md:leading-5" id="description"></p>
            </div>
        </div>

        <!-- Current Date -->
        <div class="relative text-center font-semibold text-stone-200 text-md lg:text-xl">
            <x-partials.currentdate />
        </div>

        <!-- Praytimes -->
        <div class="relative flex-1 flex items-center justify-center px-8 py-4">
            <div class="w-full h-full space-y-4">
                @for ($i=1; $i<=6; $i++) <div
                    class="bg-white/10 backdrop-blur rounded-2xl px-6 py-4 flex justify-between items-center"
                    id="{{ $i }}">
                    <div class="flex items-center space-x-2 md:space-x-3">
                        <div class="flex-shrink-0">
                            {!! $prayerIcons[$i] ?? '' !!}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-semibold truncate"
                                id="praynames{{ $i }}"></h3>
                        </div>
                    </div>
                    <div class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-bold ml-2 md:ml-4 whitespace-nowrap"
                        id="praytimes{{ $i }}"></div>
            </div>
            @endfor
        </div>
    </div>

</div>

<!-- Right Side -->
<div class="hidden lg:block w-1/2 relative overflow-hidden">

    <!-- Next Prayer -->
    <div class="z-50 fixed right-1 pt-2 hidden lg:flex">
        <div class="flex items-center">
            <div class="bg-gradient-to-b from-teal-500 to-teal-700 outline-2 outline-stone-50 py-1 px-3 rounded-l-full">
                <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"
                    class="animate-pulse h-7 lg:h-20 max-w-[30px] max-h-[30px] lg:max-w-[40px] lg:max-h-[48px]">
                    <path d="M9 4.55a8 8 0 0 1 6 14.9m0 -4.45v5h5" />
                    <path d="M5.63 7.16l0 .01" />
                    <path d="M4.06 11l0 .01" />
                    <path d="M4.63 15.1l0 .01" />
                    <path d="M7.16 18.37l0 .01" />
                    <path d="M11 19.94l0 .01" />
                </svg>
            </div>
            <div
                class="font-medium text-gray-800 text-xl lg:text-5xl tracking-tighter tabular-nums inline-flex flex-wrap items-center justify-center gap-x-2 bg-gradient-to-b from-stone-50 to-stone-300 outline-2 outline-stone-50 shadow-xl py-1 px-3 rounded-r-full whitespace-nowrap">
                <x-partials.nextprayer />
            </div>
        </div>
    </div>

    <!-- Hero -->
    <div id="hero-section">
        <x-partials.hero-with-text-small-screen :randomImages="$randomImages" />
    </div>

    <!-- Clock -->
    <div class="fixed bottom-23 right-4 lg:right-1 z-10 hidden lg:block">
        <div class="flex flex-row bg-gradient-to-r from-stone-400 to-stone-200 rounded-lg shadow-lg p-2">
            <x-partials.clock />
        </div>
    </div>
</div>

<!-- Footer -->
<div class="fixed inset-x-0 bottom-0 bg-gradient-to-r from-gray-800 to-gray-900 z-50">
    <!-- Running Text Section -->
    <x-partials.running-text :tickerText="$tickerText" />

    <!-- Copyright -->
    <x-partials.copyright />
</div>