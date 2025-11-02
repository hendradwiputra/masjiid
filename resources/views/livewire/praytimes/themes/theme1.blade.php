<!-- Header -->
<div class="fixed left-0 inset-x-0 top-0 z-50 transition-all duration-700 ease-in-out">
    <div id="date-section">
        <!-- Current Date -->
        <div id="datetime_section" class="bg-gradient-to-r from-gray-900 to-gray-600">
            <div class="mx-auto w-full py-1 px-1 text-right">
                <div class="flex flex-col">
                    <div class="font-semibold text-stone-200 text-md lg:text-2xl text-shadow-lg">
                        <x-partials.currentdate />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="profile-section"
        class="lg:absolute bg-gradient-to-l from-gray-800 to-gray-600 shadow-xl top-8 lg:top-0 p-4 z-50 lg:rounded-br-7xl w-full lg:max-w-fit transition-all duration-700 ease-in-out">
        <!-- Profile & Logo -->
        <div class="flex flex-row gap-3 items-center">
            <x-partials.logo />
            <div class="flex flex-col text-stone-200 text-xl text-shadow-lg">
                <h1 class="font-merriweather text-2xl lg:text-4xl md:leading-10 font-bold lg:mb-2 highlight-me"
                    id="name">
                </h1>
                <p class="text-sm lg:text-xl md:leading-6 lg:mb-2" id="address"></p>
                <p class="text-sm lg:text-xl md:leading-5" id="description"></p>
            </div>
        </div>
    </div>

    <div id="nextprayer-section" class="z-50 fixed right-1 pt-2">
        <!-- Next Prayer -->
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
</div>
<!-- End of header -->

<!-- Hero section -->
<div id="hero-section">
    <x-partials.hero-with-text-normal-screen :randomImages="$randomImages" />
</div>

<!-- Footer -->
<div class="fixed inset-x-0 bottom-0 z-50 mx-auto w-full">

    <div id="clock-section" class="flex justify-start mb-1">
        <!-- Clock -->
        <div class="flex flex-row bg-gradient-to-r from-stone-400 to bg-stone-200 rounded-lg mx-1">
            <x-partials.clock />
        </div>
    </div>

    <div id="praytimes-section"
        class="grid grid-cols-3 md:grid-cols-6 text-shadow-lg border-5 bg-gray-700 border-gray-700 gap-1 w-full transition-all duration-700 ease-in-out">
        <!-- Praytimes -->
        @for ($i=1; $i<=6; $i++) <div
            class="flex text-stone-200 lg:text-xl rounded-lg bg-gradient-to-b from-gray-800 to to-gray-400 md:py-2"
            id="{{ $i }}">
            <x-partials.prayertimes :i="$i" />
    </div>
    @endfor
</div>

<div id="running-text-section">
    <!-- Running Text -->
    <x-partials.running-text :tickerText="$tickerText" />
</div>

<div id="copyright-section">
    <!-- Copyright -->
    <x-partials.copyright />
</div>

</div>
<!-- End of footer -->