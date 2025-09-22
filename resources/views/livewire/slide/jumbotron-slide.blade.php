<div wire:poll.300s="loadRandomImages">

    <x-layouts.preloader />

    <div id="app-config" style="display: none;" data-random-images='@json($randomImages ?? [])'></div>

    <div id="hero_section" class="absolute inset-0 bg-gradient-to-b from-gray-900 to bg-gray-400">
        @if(!empty($randomImages))
        <img data-aos="fade-up" data-aos-duration="1000"
            src="{{ $randomImages[0] ?? asset('storage/images/upload/default-image.jpg') }}"
            alt="Random Background Image" id="random-image" class="w-full h-full object-cover object-center">
        @endif
        <div class="absolute inset-0 bg-stone-700 opacity-30"></div>
    </div>
</div>

<script src="{{ asset('storage/dist/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('storage/dist/imageRandomizer/imageRandomizer.js') }}"></script>

<script>
    function initSlideImages() {

        // Read dynamic data from DOM (updated after each poll/morph)
        const configElement = document.getElementById('app-config');
        if (!configElement) {
            console.error('Config element not found');
            return;
        }
        
        let randomImages;
        try {
            randomImages = JSON.parse(configElement.dataset.randomImages) || [];
        } catch (error) {
            console.error('Error parsing app-config JSON:', error);
            return;
        }

        // Initialize image randomizer
        if (typeof window.initImageRandomizer !== 'function') {
            console.error('initImageRandomizer is not defined. Ensure imageRandomizer.js is loaded correctly.');
            return;
        }
        window.prayTimesRandomizer = window.initImageRandomizer('random-image', randomImages, 8000);
    
    }

    initSlideImages();

    // Re-init after Livewire updates
    document.addEventListener('livewire:initialized', function () {
        Livewire.hook('morphed', ({ el, component }) => {
            initPrayTimes();
            console.log('Livewire morphed - re-init complete');
        });
    });

</script>