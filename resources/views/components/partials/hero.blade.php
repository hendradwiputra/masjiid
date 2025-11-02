<div class="relative w-full h-full min-h-screen overflow-hidden">

    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to bg-gray-400 overflow-hidden">
        <!-- Background Image -->
        @if(!empty($randomImages) && is_array($randomImages) && !empty($randomImages[0]['url']))
        <img src="{{ $randomImages[0]['url'] ?? asset('storage/images/upload/default-image.webp') }}"
            alt="Random Background Image" id="random-image" class="absolute inset-0 w-full h-full object-cover">
        @endif

        <!-- Dark overlay for readability -->
        <div class="absolute inset-0 bg-black/10"></div>
    </div>

</div>