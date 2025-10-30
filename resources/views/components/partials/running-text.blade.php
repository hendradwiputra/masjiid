<div
    class="p-2 left-0 w-full overflow-hidden bg-gradient-to-l from-gray-950 to bg-gray-800 text-stone-100 text-xl lg:text-5xl font-medium whitespace-nowrap z-50">
    <div id="running-text" class="flex animate-scroll">
        {{ $tickerText }}
    </div>
</div>

<style>
    @keyframes scroll {
        0% {
            transform: translateX(50%);
            transition: transform 0.5s ease-in-out;
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .animate-scroll {
        display: inline-block;
        animation: scroll 30s linear infinite;
    }
</style>