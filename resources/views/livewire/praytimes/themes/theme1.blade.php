<!-- Header -->
<div class="fixed left-0 inset-x-0 top-0 z-50 transition-all duration-700 ease-in-out">
    <div id="date-section">
        <!-- Current Date -->
        @include('livewire.praytimes.partials.currentdate')
    </div>

    <div id="profile-section"
        class="lg:absolute bg-gradient-to-r from-stone-800 to bg-stone-400 shadow-xl top-8 lg:top-0 p-4 z-50 lg:rounded-br-7xl w-full lg:max-w-3xl transition-all duration-700 ease-in-out">
        <!-- Profile & Logo -->
        @include('livewire.praytimes.partials.profile-logo-left')
    </div>

    <div id="nextprayer-section" class="z-50 fixed right-1 pt-1 lg:pt-1">
        <!-- Next Prayer -->
        @include('livewire.praytimes.partials.nextprayer')
    </div>
</div>
<!-- End of header -->

<!-- Hero section -->
<div id="hero-section">
    @include('livewire.praytimes.partials.hero')
</div>

<!-- Footer -->
<div class="fixed inset-x-0 bottom-0 z-50 mx-auto w-full">

    <div id="clock-section" class="flex justify-start mb-1">
        <!-- Clock -->
        @include('livewire.praytimes.partials.clock')
    </div>

    <div id="praytimes-section"
        class="grid grid-cols-3 md:grid-cols-6 text-shadow-lg border-5 bg-stone-700 border-stone-700 gap-1 w-full transition-all duration-700 ease-in-out">
        <!-- Praytimes -->
        @include('livewire.praytimes.partials.prayertimes')
    </div>

    <!-- Running Text -->
    @include('livewire.praytimes.partials.running-text')

    <!-- Copyright -->
    @include('livewire.praytimes.partials.copyright')
</div>
<!-- End of footer -->