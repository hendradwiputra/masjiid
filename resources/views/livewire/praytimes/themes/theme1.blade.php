<!-- Header -->
<div class="fixed left-0 inset-x-0 top-0 z-50 transition-all duration-700 ease-in-out">
    <div id="date-section">
        <!-- Current Date -->
        <div id="datetime_section" class="bg-gradient-to-l from-blue-950 to-blue-400">
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
        class="lg:absolute bg-gradient-to-r from-gray-900 to-gray-500 shadow-lg top-8 lg:top-0 p-4 z-50 lg:rounded-br-7xl w-full lg:max-w-fit transition-all duration-700 ease-in-out">
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

    <div id="nextprayer-section" class="z-50 fixed right-1 pt-1">
        <!-- Next Prayer -->
        <x-partials.nextprayer-1 />
    </div>
</div>
<!-- End of header -->

<!-- Hero section -->
<div id="hero-section" class="relative w-full h-full overflow-hidden">
    <x-partials.hero :randomImages="$randomImages" />
</div>

<!-- Footer -->
<div class="fixed inset-x-0 bottom-0 z-50 mx-auto w-full">

    <div id="clock-section" class="flex justify-start px-1 mb-1">
        <!-- Clock -->
        <x-partials.clock-1 />
    </div>

    <div id="praytimes-section"
        class="grid grid-cols-3 md:grid-cols-6 text-shadow-lg backdrop-blur-sm gap-1 py-2 px-1 w-full transition-all duration-700 ease-in-out">
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
    <x-partials.running-text :tickerText="$tickerText" :appSetting="$appSetting" />
</div>

<div>
    <!-- Copyright -->
    <x-partials.copyright />
</div>

</div>
<!-- End of footer -->