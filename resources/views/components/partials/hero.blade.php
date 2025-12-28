<div class="relative w-full h-full min-h-screen overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to bg-gray-400 overflow-hidden">
        <!-- Background Media Container -->
        <div id="random-image" class="absolute inset-0 w-full h-full">
            <!-- Images/videos will be inserted here dynamically -->
        </div>

        <!-- Dark overlay for better text readability -->
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Text Overlay - This is the new part -->
        <div class="absolute inset-0 flex flex-col justify-center text-center p-8 md:p-16 pointer-events-none">
            <div class="max-w-full text-white">
                <h1 id="slide-title"
                    class="font-merriweather font-bold text-amber-300 text-xl sm:text-2xl md:text-4xl lg:text-6xl leading-tight text-shadow-sm text-shadow-gray-900 mb-4 opacity-0 transition-opacity duration-1000">
                    <!-- Title will appear here -->
                </h1>
                <p id="slide-content"
                    class="font-semibold text-stone-50 text-sm sm:text-base md:text-3xl lg:text-4xl text-shadow-sm text-shadow-gray-900 leading-none mb-3 opacity-0 transition-opacity duration-1000">
                    <!-- Content/description here -->
                </p>
                <p id="slide-author"
                    class="font-semibold text-stone-50 text-xs sm:text-sm md:text-2xl italic text-shadow-sm text-shadow-gray-900 opacity-0 transition-opacity duration-1000">
                    <!-- Author or credit here -->
                </p>
            </div>
        </div>
    </div>
</div>