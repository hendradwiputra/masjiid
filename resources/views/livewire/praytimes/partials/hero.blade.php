<div class="relative h-screen overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to bg-gray-400 overflow-hidden">
        @if(!empty($randomImages) && is_array($randomImages) && !empty($randomImages[0]['url']))
        <img src="{{ $randomImages[0]['url'] ?? asset('storage/images/upload/default-image.jpg') }}"
            alt="Random Background Image" id="random-image"
            class="w-full h-full object-cover object-center transition-opacity duration-700 ease-in-out">
        @endif
        <div class="absolute inset-0 bg-stone-950 opacity-10"></div> <!-- Slightly darker for contrast -->
    </div>

    <!-- CENTERED METADATA -->
    @if(!empty($randomImages) && is_array($randomImages) && !empty($randomImages[0]['url']))
    <div class="absolute inset-0 flex items-center justify-center z-40 pointer-events-none">
        <div
            class="text-center p-4 md:p-6 bg-white/30 backdrop-blur-xs bg-opacity-70 text-white max-w-screen mx-4 rounded-2xl">
            <h2 id="slide-title"
                class="text-gray-900 text-2xl md:text-4xl lg:text-7xl font-bold mb-3 leading-tight text-shadow-lg text-shadow-gray-200">
                {{ $randomImages[0]['title'] ?? 'No Title' }}
            </h2>
            <p id="slide-content"
                class="text-gray-100 text-base md:text-2xl lg:text-5xl font-semibold mb-2 leading-none mx-auto text-shadow-lg text-shadow-gray-800">
                {{ $randomImages[0]['content'] ?? 'No Content' }}
            </p>
            <p id="slide-author"
                class="text-gray-100 text-sm md:text-xl font-semibold italic text-shadow-lg text-shadow-gray-800">
                — {{ $randomImages[0]['author'] ?? 'Unknown Author' }}
            </p>
        </div>
    </div>
    @endif
</div>