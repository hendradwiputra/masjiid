<div wire:poll.300s="loadRandomImages">

    <x-layouts.preloader />

    <div id="app-config" style="display: none;" data-random-images='@json($randomImages ?? [])'></div>

    <!-- Jumbotron section -->
    <div id="jumbotron-section">
        @include('livewire.praytimes.partials.hero')
    </div>
</div>
</div>

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
        window.imageRandomizer = window.initImageRandomizer('random-image', randomImages, 8000);
    
    }

    initSlideImages();

    // Re-init after Livewire updates
    document.addEventListener('livewire:initialized', function () {
        Livewire.hook('morphed', ({ el, component }) => {
            initSlideImages();
            console.log('Livewire morphed - re-init complete');
        });
    });

</script>