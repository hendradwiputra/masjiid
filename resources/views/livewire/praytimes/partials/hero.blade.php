<div class="relative h-screen overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to bg-gray-400 overflow-hidden">
        @if(!empty($randomImages) && is_array($randomImages) && !empty($randomImages[0]['url']))
        <img src="{{ $randomImages[0]['url'] ?? asset('storage/images/upload/default-image.jpg') }}"
            alt="Random Background Image" id="random-image"
            class="w-full h-full object-cover object-center transition-opacity duration-700 ease-in-out">
        @endif
        <div class="absolute inset-0 bg-stone-800 opacity-10"></div> <!-- Slightly darker for contrast -->
    </div>

    <!-- CENTERED METADATA -->
    @if(!empty($randomImages) && is_array($randomImages) && !empty($randomImages[0]['url']))
    <div class="absolute inset-0 flex items-center justify-center z-40 pointer-events-none">
        <div class="text-center p-6 md:p-8 bg-opacity-70 text-white max-w-4xl mx-4">
            <h2 id="slide-title" class="text-2xl md:text-4xl lg:text-5xl font-bold mb-3 leading-tight">
                {{ $randomImages[0]['title'] ?? 'No Title' }}
            </h2>
            <p id="slide-content" class="text-sm md:text-lg mb-2 opacity-90 leading-relaxed max-w-3xl mx-auto">
                {{ $randomImages[0]['content'] ?? 'No Content' }}
            </p>
            <p id="slide-author" class="text-xs md:text-base italic opacity-80">
                — {{ $randomImages[0]['author'] ?? 'Unknown Author' }}
            </p>
        </div>
    </div>
    @endif
</div>