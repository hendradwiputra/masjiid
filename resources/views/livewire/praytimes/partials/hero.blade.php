<div class="relative h-screen overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to bg-gray-400 overflow-hidden">
        @if(!empty($randomImages) && is_array($randomImages) && !empty($randomImages[0]['url']))
        <img src="{{ $randomImages[0]['url'] ?? asset('storage/images/upload/default-image.webp') }}"
            alt="Random Background Image" id="random-image"
            class="w-full h-full object-cover object-center transition-opacity duration-700 ease-in-out">
        @endif
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <!-- Slightly darker for contrast -->
    </div>

    <!-- CENTERED METADATA -->
    @if(!empty($randomImages) && is_array($randomImages) && !empty($randomImages[0]['url']))
    <div class="absolute inset-0 flex items-center justify-center z-40 pointer-events-none">
        <div class="text-center p-4 md:p-6 bg-opacity-70 max-w-7xl">
            <h2 id="slide-title" class="font-bold text-gray-300 text-2xl md:text-4xl lg:text-7xl leading-tight text-shadow-lg
                   text-shadow-gray-900 mb-3">
                {{ $randomImages[0]['title'] ?? '' }}
            </h2>
            <p id="slide-content" class="font-semibold text-amber-50 text-base md:text-2xl lg:text-5xl text-shadow-lg text-shadow-gray-900 leading-none 
                 mb-2 mx-auto">
                {{ $randomImages[0]['content'] ?? '' }}
            </p>
            <p id="slide-author" class="font-semibold text-amber-50 text-sm md:text-xl italic text-shadow-lg text-shadow-gray-900
                mb-2 mx-auto">
                — {{ $randomImages[0]['author'] ?? '' }}
            </p>
        </div>
    </div>
    @endif

</div>