<div class="relative w-full h-full min-h-screen overflow-hidden">

    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to bg-gray-400 overflow-hidden">
        <!-- Background Image -->
        @if(!empty($randomImages) && is_array($randomImages) && !empty($randomImages[0]['url']))
        <img src="{{ $randomImages[0]['url'] ?? asset('storage/images/upload/default-image.webp') }}"
            alt="Random Background Image" id="random-image" class="absolute inset-0 w-full h-full object-cover">
        @endif

        <!-- Dark overlay for readability -->
        <div class="absolute inset-0 bg-black opacity-60"></div>
    </div>

    <!-- Add text over image -->
    @if(!empty($randomImages) && is_array($randomImages) && !empty($randomImages[0]['url']))
    <div class="absolute inset-0 flex items-center justify-center z-40 pointer-events-none">
        <div class="text-center p-2 sm:p-4 bg-opacity-70 max-w-7xl">
            <h2 id="slide-title"
                class="font-bold text-amber-300 text-xl sm:text-2xl md:text-4xl lg:text-6xl leading-tight text-shadow-sm text-shadow-gray-900 mb-2">
                {{ $randomImages[0]['title'] ?? '' }}
            </h2>
            <p id="slide-content"
                class="font-semibold text-stone-50 text-sm sm:text-base md:text-3xl lg:text-5xl text-shadow-sm text-shadow-gray-900 leading-none mb-1 mx-auto">
                {{ $randomImages[0]['content'] ?? '' }}
            </p>
            <p id="slide-author"
                class="font-semibold text-stone-50 text-xs sm:text-sm md:text-2xl italic text-shadow-sm text-shadow-gray-900 mb-1 mx-auto">
                — {{ $randomImages[0]['author'] ?? '' }}
            </p>
        </div>
    </div>
    @endif

</div>