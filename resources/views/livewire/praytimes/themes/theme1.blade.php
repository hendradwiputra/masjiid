<!-- Header -->
<div class="fixed inset-x-0 top-0 z-50">
    <!-- Datetime -->
    <div class="bg-gradient-to-l from-gray-900 to bg-gray-400">
        <div class="mx-auto w-full py-1 px-1">
            <div class="flex flex-col">
                <p class="font-mavenpro font-semibold text-stone-200 text-md lg:text-xl text-right text-shadow-lg highlight-me mr-1"
                    id="current_date"></p>
            </div>
        </div>
    </div>
    <!-- End of datetime -->

    <!-- Profile name -->
    <div
        class="lg:absolute bg-gradient-to-r from-stone-800 to bg-stone-400 shadow-xl top-8 lg:top-0 p-2 z-50 lg:rounded-br-full w-full lg:max-w-3xl">
        <div class="flex flex-row gap-4 items-center">
            <img id="logo" alt="" class="self-center flex-shrink-0 h-18 w-18 lg:h-26 lg:w-26">
            <div class="flex flex-col text-stone-200 text-xl text-shadow-lg">
                <h4 class="font-mavenpro text-2xl lg:text-5xl md:leading-10 font-bold pr-5 lg:mb-2 highlight-me"
                    id="name">
                </h4>
                <p class="font-montserrat text-sm lg:text-lg md:leading-5 lg:mb-2 mr-5" id="address"></p>
                <p class="font-montserrat text-sm lg:text-lg md:leading-4" id="description"></p>
            </div>
        </div>
    </div>
    <!-- End of profile name -->

    <!-- Praytimes counter -->
    <div class="lg:absolute z-50 right-1 pt-1 lg:pt-1">
        <span
            class="font-montserrat font-semibold text-stone-100 text-sm lg:text-4xl tracking-tight tabular-nums inline-flex flex-wrap items-center justify-center gap-x-2 bg-gradient-to-r from-amber-600 to-amber-400 shadow-xl py-1 px-3 rounded-full whitespace-nowrap"
            id="nextPrayName"></span>
    </div>
    <!-- End of praytimes counter -->
</div>
<!-- End of header -->

<!-- Hero section -->
<div class="absolute inset-0 bg-gradient-to-b from-gray-900 to bg-gray-400">
    @if(!empty($imagePaths))
    <img src="{{ asset($imagePaths[0]) }}" alt="Random Image" id="random-image" @endif
        class="w-full h-full object-cover object-center">
    <div class="absolute inset-0 bg-black opacity-30"></div>
</div>
<!-- End of hero -->

<div class="fixed inset-x-0 bottom-0 z-50">
    <!-- Clock -->
    <div class="flex justify-between mb-1">
        <div class="flex flex-row bg-gradient-to-r from-stone-400 to bg-stone-200">
            <h1 class="font-montserrat text-5xl lg:text-8xl font-bold text-gray-800 text-shadow-lg mx-2" id="clock">
            </h1>
            <div class="flex-row mr-2">
                <h4 class="font-montserrat font-bold text-teal-800 text-2xl lg:text-5xl text-shadow-lg lg:pt-2 tabular-nums"
                    id="seconds"></h4>
                <h4 class="font-montserrat font-bold text-teal-800 text-base lg:text-4xl text-shadow-lg leading-1 lg:leading-5"
                    id="ampm"></h4>
            </div>
        </div>
    </div>
    <!-- End of clock -->

    <!-- Praytimes -->
    <div class="grid grid-cols-3 md:grid-cols-6 text-shadow-lg border-5 bg-stone-700 border-stone-700 gap-1 w-full">
        @for ($i=1; $i<=6; $i++) <div
            class="flex text-stone-200 lg:text-xl rounded-lg bg-gradient-to-b from-stone-700 to to-stone-400 md:py-2"
            id="{{ $i }}">
            <div class="mx-auto">
                <h4 class="font-mavenpro font-semibold text-xl lg:text-4xl" id="praynames{{ $i }}"></h4>
                <h1 class="font-montserrat font-bold text-2xl lg:text-7xl leading-4 lg:leading-14 mb-1"
                    id="praytimes{{ $i }}"></h1>
            </div>
    </div>
    @endfor
</div>
<!-- End of prayertime -->

<!-- Footer -->
@include('livewire.praytimes.footer')
<!-- End of footer -->
</div>