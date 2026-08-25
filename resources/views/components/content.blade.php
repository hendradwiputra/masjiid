<div class="relative">

    <x-session-msg />

    <!-- Mobile Header with Toggle -->
    <div class="md:hidden flex items-center justify-between mb-4">
        <button @click.stop="sidebarOpen = !sidebarOpen" aria-label="Toggle sidebar"
            class="p-2.5 rounded-xl bg-white shadow-md text-slate-700 hover:bg-slate-50 transition-all duration-200 hover:scale-105 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <span class="text-sm">
            <x-page-title />
        </span>

        <div class="w-10"></div> <!-- Spacer for balance -->
    </div>

    <div class="flex items-center justify-between mb-6">
        <div class="hidden md:block">
            <x-page-title />
        </div>
        <span
            class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-full text-xs font-medium border border-blue-200 md:ml-4 ml-auto">
            <div class="flex items-center gap-1">
                <x-heroicon-o-calendar class="w-4 h-4 inline-block mr-1" />
                <x-add-date />
            </div>
        </span>
    </div>

    <div
        class="bg-white backdrop-blur-sm rounded-2xl p-6 border border-stone-200 transition-all duration-300 hover:shadow-2xl hover:shadow-slate-200/60">
        {{ $slot }}
    </div>
</div>