<div class="h-screen text-white overflow-hidden flex">

    <!-- Left Side -->
    <div class="w-full lg:w-1/4 flex flex-col relative bg-gradient-to-l from-gray-900 to-gray-600">
        <!-- Praytimes -->
        <div class="relative flex-1 flex items-center justify-center px-4 py-4">
            <div class="w-full h-full space-y-4">
                @for ($i=1; $i<=6; $i++) <div
                    class="bg-white/10 backdrop-blur rounded-2xl px-8 py-1 md:py-2 lg:py-2 flex items-center"
                    id="{{ $i }}">
                    <div class="flex items-center space-x-2 md:space-x-8">
                        <div class="flex-shrink-0">
                            {!! $prayerIcons[$i] ?? '' !!}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-xl md:text-2xl lg:text-4xl font-semibold truncate" id="praynames{{ $i }}">
                            </h3>
                            <div class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-bold whitespace-nowrap"
                                id="praytimes{{ $i }}"></div>
                        </div>
                    </div>
            </div>
            @endfor
        </div>

        <!-- Clock -->
        <div class="fixed bottom-0 flex flex-row w-full bg-white/30 backdrop-blur p-2 items-center justify-center">
            <x-partials.clock />
        </div>

    </div>

    <!-- Right Side -->
    <div class="w-3/4 fixed right-0 overflow-hidden hidden lg:block">

        <!-- Hero -->
        <div id="hero-section">
            <x-partials.hero-with-text-small-screen :randomImages="$randomImages" />
        </div>

        <!-- Profile -->
        <div id="profile-section"
            class="absolute inset-x-0 bg-gradient-to-r from-gray-900 to-gray-400 shadow-xl top-0 p-4 w-full transition-all duration-700 ease-in-out">

            <!-- Profile & Logo -->
            <div class="flex flex-row gap-4 items-center justify-end">
                <div class="flex flex-col text-stone-200 text-right text-xl text-shadow-lg">
                    <h1 class="font-merriweather text-2xl lg:text-4xl md:leading-10 font-bold lg:mb-2 highlight-me"
                        id="name">
                    </h1>
                    <p class="text-sm lg:text-xl md:leading-6 lg:mb-2" id="address"></p>
                    <p class="text-sm lg:text-xl md:leading-5" id="description"></p>
                </div>
                <x-partials.logo />
            </div>

            <!-- Current Date -->
            <div id="datetime_section"
                class="absolute inset-x-0 w-full bg-gradient-to-r from-blue-950 to-blue-400 border-t-2 border-t-blue-200 mt-2">
                <div class="mx-auto w-full py-1 px-1 text-right">
                    <div class="flex flex-col">
                        <div class="font-semibold text-stone-200 text-md lg:text-2xl text-shadow-lg">
                            <x-partials.currentdate />
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-r from-gray-800 to-gray-900 z-50">

            <!-- Next Prayer -->
            <div id="nextprayer-section" class="fixed bottom-24 right-1">
                <x-partials.nextprayer />
            </div>

            <!-- Running Text Section -->
            <x-partials.running-text :tickerText="$tickerText" />

            <!-- Copyright -->
            <div id="copyright-section">
                <x-partials.copyright />
            </div>

        </div>

    </div>
</div>