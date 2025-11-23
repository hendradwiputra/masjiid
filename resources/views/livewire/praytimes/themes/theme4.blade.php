<div class="relative h-screen">
    <x-partials.hero :randomImages="$randomImages" />

    <!-- Overlay Content -->
    <div class="absolute inset-0 flex flex-col">

        <!-- Top Bar -->
        <div class="bg-gradient-to-r from-black/70 via-transparent to-black/70
                    backdrop-blur-sm text-white">
            <div id="profile-section" class="flex justify-between items-center mx-3 py-2">
                <div class="flex">
                    <x-partials.clock-2 />
                </div>

                <div class="flex items-center justify-end gap-4">
                    <div class="text-right">
                        <h1 class="font-merriweather text-3xl lg:text-4xl font-bold drop-shadow-md highlight-me"
                            id="name">
                        </h1>
                        <p class="text-sm lg:text-xl mt-1" id="address"></p>
                        <p class="text-xs lg:text-xl mt-1" id="description"></p>
                    </div>
                    <div class="flex-shrink-0">
                        <x-partials.logo />
                    </div>
                </div>
            </div>

            <div id="date-section"
                class="font-semibold text-right bg-blue-900/80 p-1 text-stone-200 text-md lg:text-2xl text-shadow-lg px-2">
                <x-partials.currentdate />
            </div>
        </div>

        <!-- Main Content Area - Centered Praytimes Grid -->
        <div class="flex-1 flex items-center justify-center p-2">
            <div id="praytimes-section" class="w-full max-w-4xl">
                <div class="grid grid-cols-3 gap-5">
                    @for ($i=1; $i<=6; $i++) <div
                        class="bg-black/40 backdrop-blur rounded-2xl p-3 flex flex-col items-center justify-center text-white border border-white/30"
                        id="{{ $i }}">
                        <div class="flex items-center space-x-2 md:space-x-3">
                            <div class="flex-shrink-0">
                                {!! $prayerIcons[$i] ?? '' !!}
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl md:text-2xl lg:text-3xl font-semibold text-shadow-sm text-shadow-gray-800 truncate"
                                id="praynames{{ $i }}">
                            </h3>
                        </div>
                        <div class="text-lg sm:text-xl md:text-2xl lg:text-6xl font-bold ml-2 md:ml-4 text-shadow-sm text-shadow-gray-800 whitespace-nowrap"
                            id="praytimes{{ $i }}">
                        </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="bg-gradient-to-t from-black/80 to-transparent text-white">
        <div class="flex items-baseline-last justify-between">

            <!-- Next Prayer -->
            <div id="nextprayer-section" class="px-2">
                <x-partials.nextprayer-1 />
            </div>
        </div>

        <x-partials.running-text :tickerText="$tickerText" />

        <div id="copyright-section" class="opacity-70">
            <x-partials.copyright />
        </div>
    </div>
</div>