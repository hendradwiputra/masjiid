<div class="absolute inset-0 bg-gradient-to-b from-gray-900 to bg-gray-400">
    @if(!empty($randomImages))
    <img src="{{ $randomImages[0] ?? asset('storage/images/upload/default-image.jpg') }}" alt="Random Background Image"
        id="random-image" class="w-full h-full object-cover object-center transition-opacity duration-700 ease-in-out">
    @endif
    <div class="absolute inset-0 bg-stone-700 opacity-30"></div>
</div>