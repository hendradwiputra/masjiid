@if (session()->has('message'))
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-full"
    class="fixed top-4 right-4 z-50 max-w-sm w-full bg-white rounded-lg shadow-lg border border-gray-200 transform">

    <div class="flex items-center p-4">
        <div class="flex-shrink-0">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-gray-900">Berhasil</p>
            <p class="text-sm text-gray-500 mt-1">{{ session('message') }}</p>
        </div>

        <button @click="show = false" class="flex-shrink-0 ml-4 text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Progress bar -->
    <div class="w-full bg-gray-200 rounded-full h-1">
        <div x-data="{ width: '100%' }" x-init="setTimeout(() => width = '0%', 100)"
            x-transition:enter="transition-all duration-4000 ease-linear" :style="`width: ${width}`"
            class="h-1 bg-green-600 rounded-full transition-all duration-4000 ease-linear">
        </div>
    </div>
</div>
@endif