<div class="h-screen bg-gradient-to-r from-gray-900 to-gray-400 text-white overflow-hidden flex">

    <!-- Left Side -->
    <div class="w-full lg:w-1/2 flex flex-col relative">

        <!-- Profile -->
        <div class="relative p-5 text-center">
            <div class="flex flex-col text-stone-200 text-xl text-shadow-lg">
                <h1 class="font-merriweather font-bold text-xl lg:text-3xl md:leading-8 lg:mb-2 highlight-me" id="name">
                </h1>
                <p class="text-base md:text-lg lg:text-xl md:leading-5 lg:mb-2" id="address"></p>
                <p class="text-base md:text-lg lg:text-xl md:leading-5" id="description"></p>
            </div>
        </div>

        <!-- Current Date -->
        <div
            class="relative text-center font-semibold text-stone-200 text-md md:text-lg lg:text-xl bg-gradient-to-r from-blue-950 to-blue-400 py-1 mb-2">
            <x-partials.currentdate />
        </div>

        <!-- Praytimes -->
        <div class="relative flex-1 flex items-center justify-center px-8 py-4">
            <div class="w-full h-full space-y-4">
                @for ($i=1; $i<=6; $i++) <div
                    class="bg-white/10 backdrop-blur rounded-2xl px-6 py-1 md:py-2 lg:py-4 flex justify-between items-center"
                    id="{{ $i }}">
                    <div class="flex items-center space-x-2 md:space-x-3">
                        <div class="flex-shrink-0">
                            {!! $prayerIcons[$i] ?? '' !!}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-xl md:text-2xl lg:text-4xl font-semibold truncate" id="praynames{{ $i }}">
                            </h3>
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
    <div id="nextprayer-section" class="z-50 fixed right-1 pt-2 hidden lg:flex">
        <x-partials.nextprayer />
    </div>

    <!-- Hero -->
    <div id="hero-section">
        <x-partials.hero-with-text-small-screen :randomImages="$randomImages" />
    </div>

    <!-- Clock -->
    <div id="clock-section" class="fixed bottom-23 right-4 lg:right-1 z-10 hidden lg:block">
        <div class="flex flex-row bg-white/30 backdrop-blur rounded-lg shadow-lg p-0">
            <x-partials.clock />
        </div>
    </div>
</div>

<!-- Footer -->
<div class="fixed inset-x-0 bottom-0 bg-gradient-to-r from-gray-800 to-gray-900 z-50">
    <!-- Running Text Section -->
    <x-partials.running-text :tickerText="$tickerText" />

    <!-- Copyright -->
    <div id="copyright-section">
        <x-partials.copyright />
    </div>

</div>