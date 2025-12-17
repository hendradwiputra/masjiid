<div class="h-screen bg-gradient-to-r from-gray-900 to-gray-400 text-white overflow-hidden flex flex-col">
    <!-- Main Content Area -->
    <div class="flex-1 flex overflow-hidden" id="main-container">

        <!-- Left Side -->
        <div class="w-full lg:w-1/2 flex flex-col relative transition-all duration-500 ease-in-out" id="left-side">
            <!-- Praytimes Section -->
            <div class="relative flex-1 flex items-center justify-center px-8 py-2 pb-22" id="praytimes-section">

                <div class="w-full h-full grid grid-rows-6 gap-3">
                    @for ($i=1; $i<=6; $i++) <div
                        class="bg-white/10 backdrop-blur rounded-2xl px-6 flex justify-between items-center relative"
                        id="{{ $i }}">
                        <div class="flex items-center space-x-2 md:space-x-3 flex-1">
                            <div class="flex-shrink-0 text-amber-200">
                                {!! $prayerIcons[$i] ?? '' !!}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-xl md:text-2xl lg:text-4xl text-shadow-sm text-shadow-gray-800 font-semibold"
                                    id="praynames{{ $i }}"></h3>
                            </div>
                        </div>

                        <!-- Centered dotted circle -->
                        <div
                            class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                            <div class="flex size-3 space-x-1">
                                <span class="size-3 bg-white rounded-full"></span>
                            </div>
                        </div>

                        <div class="text-lg sm:text-xl md:text-2xl lg:text-6xl text-shadow-sm text-shadow-gray-800 font-bold ml-2 md:ml-4 whitespace-nowrap flex-1 text-right"
                            id="praytimes{{ $i }}"></div>
                </div>
                @endfor

                <!-- Next Prayer Section -->
                <div class="flex justify-center items-center" id="nextprayer-section">
                    <x-partials.nextprayer-2 />
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side -->
    <div class="hidden lg:block w-1/2 lg:w-1/2 relative overflow-hidden transition-all duration-500 ease-in-out"
        id="right-side">
        <!-- Hero -->
        <div id="hero-section" class="relative w-full h-full overflow-hidden">
            <x-partials.hero :randomImages="$randomImages" />
        </div>

        {{-- Header --}}
        <div id="profile-section" class="flex justify-end items-center absolute top-0 right-0 p-2 bg-gradient-to-r from-black/70 via-transparent to-black/70
                        backdrop-blur-sm border-b border-white/10 w-full">

            {{-- Profile --}}
            <div class="flex w2/3 items-center justify-end gap-4 p-2">
                <div class="text-right">
                    <h1 class="font-merriweather text-2xl lg:text-3xl font-bold drop-shadow-md highlight-me" id="name">
                    </h1>
                    <p class="text-base lg:text-lg" id="address"></p>
                    <p class="text-base lg:text-lg" id="description"></p>
                </div>
                <div class="flex-shrink-0">
                    <x-partials.logo />
                </div>
            </div>

            {{-- Current Date --}}
            <div id="date-section" class="absolute -bottom-8 left-0 right-0 bg-gradient-to-r from-blue-950/80 to-blue-700/80 
                              backdrop-blur-sm border-t border-indigo-300/30">
                <div class="text-right font-medium text-lg lg:text-2xl drop-shadow px-2">
                    <x-partials.currentdate />
                </div>
            </div>
        </div>

        <!-- Clock -->
        <div class="fixed bottom-24 right-0 px-1 z-10" id="clock-section">
            <x-partials.clock-1 />
        </div>
    </div>
</div>

<!-- Footer: Running Text + Copyright (Never Overlap) -->
<div class="fixed inset-x-0 bottom-0 z-50">

    <!-- Running Text (100px tall, always visible) -->
    <div class="relative">
        <x-partials.running-text :tickerText="$tickerText" :appSetting="$appSetting" />
    </div>

    <!-- Copyright (Sits cleanly below) -->
    <div class="bg-black/95 text-center text-white text-xs md:text-sm backdrop-blur-md border-t border-white/10">
        <x-partials.copyright />
    </div>
</div>