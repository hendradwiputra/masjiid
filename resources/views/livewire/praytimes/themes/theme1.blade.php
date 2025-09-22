<!-- Header -->
<div class="fixed left-0 inset-x-0 top-0 z-50">
    <!-- Current Date -->
    @include('livewire.praytimes.partials.currentdate')

    <div id="profile_section"
        class="lg:absolute bg-gradient-to-r from-stone-800 to bg-stone-400 shadow-xl top-8 lg:top-0 p-4 z-50 lg:rounded-br-7xl w-full lg:max-w-3xl">
        <!-- Profile & Logo -->
        @include('livewire.praytimes.partials.profile-logo-left')
    </div>

    <div id="nextprayer_section" class="z-50 fixed right-1 pt-1 lg:pt-1">
        <!-- Next Prayer -->
        @include('livewire.praytimes.partials.nextprayer')
    </div>
</div>
<!-- End of header -->

<!-- Hero section -->
<div id="hero_section">
    @include('livewire.praytimes.partials.hero')
</div>

<!-- Footer -->
<div class="fixed inset-x-0 bottom-0 z-50 mx-auto w-full">

    <div id="clock_section" class="flex justify-start mb-1">
        <!-- Clock -->
        @include('livewire.praytimes.partials.clock')
    </div>

    <div id="praytimes_section"
        class="grid grid-cols-3 md:grid-cols-6 text-shadow-lg border-5 bg-stone-700 border-stone-700 gap-1 w-full">
        <!-- Praytimes -->
        @include('livewire.praytimes.partials.prayertimes')
    </div>

    <!-- Running Text -->
    @include('livewire.notification.running-text-display')

    <!-- Copyright -->
    @include('livewire.praytimes.partials.copyright')
</div>
<!-- End of footer -->