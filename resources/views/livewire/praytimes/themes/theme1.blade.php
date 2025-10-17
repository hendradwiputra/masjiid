<!-- Header -->
<div class="fixed left-0 inset-x-0 top-0 z-50 transition-all duration-700 ease-in-out">
    <div id="date-section">
        <!-- Current Date -->
        <div id="datetime_section" class="bg-gradient-to-l from-stone-800 to bg-stone-400">
            <div class="mx-auto w-full py-1 px-1">
                @include('livewire.praytimes.partials.currentdate')
            </div>
        </div>
    </div>

    <div id="profile-section"
        class="lg:absolute bg-gradient-to-r from-stone-800 to bg-stone-400 shadow-xl top-8 lg:top-0 p-4 z-50 lg:rounded-br-7xl w-full lg:max-w-3xl transition-all duration-700 ease-in-out">
        <!-- Profile & Logo -->
        @include('livewire.praytimes.partials.profile-logo-left')
    </div>

    <div id="nextprayer-section" class="z-50 fixed right-1 pt-2 lg:pt-2">
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
                @include('livewire.praytimes.partials.nextprayer')
            </div>
        </div>
    </div>
</div>
<!-- End of header -->

<!-- Hero section -->
<div id="hero-section">
    @include('livewire.praytimes.partials.hero')
</div>

<!-- Footer -->
<div class="fixed inset-x-0 bottom-0 z-50 mx-auto w-full">

    <div id="clock-section" class="flex justify-start mb-1">
        <!-- Clock -->
        <div class="flex flex-row bg-gradient-to-r from-stone-400 to bg-stone-200">
            @include('livewire.praytimes.partials.clock')
        </div>
    </div>

    <div id="praytimes-section"
        class="grid grid-cols-3 md:grid-cols-6 text-shadow-lg border-5 bg-stone-700 border-stone-700 gap-1 w-full transition-all duration-700 ease-in-out">
        <!-- Praytimes -->
        @include('livewire.praytimes.partials.prayertimes')
    </div>

    <!-- Running Text -->
    @include('livewire.praytimes.partials.running-text')

    <!-- Copyright -->
    @include('livewire.praytimes.partials.copyright')
</div>
<!-- End of footer -->