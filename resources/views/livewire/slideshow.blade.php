<div class="relative w-full h-screen overflow-hidden" wire:poll.60s>
    <div x-data="{
        slides: @js($slides),
        currentSlide: 0,
        paused: false,
        interval: null,
        init() {
            this.startSlideshow();
        },
        startSlideshow() {
            this.interval = setInterval(() => {
                if (!this.paused) {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                }
            }, this.slides[this.currentSlide].duration);
        },
        togglePause() {
            this.paused = !this.paused;
        }
    }" @click="togglePause" x-cloak>
        @foreach ($slides as $index => $slide)
        <div x-show="currentSlide === {{ $index }}" class="absolute inset-0 transition-opacity duration-500"
            :class="{ 'opacity-100': currentSlide === {{ $index }}, 'opacity-0': currentSlide !== {{ $index }} }">
            @livewire($slide['component'])
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('refreshSlides', () => {
            window.location.reload(); // Refresh to update prayer times or slides
        });
    });
</script>