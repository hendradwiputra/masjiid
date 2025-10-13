@php
$isSettingsActive = request()->is('profile*') ||
request()->is('praytimes*') ||
request()->is('notification') ||
request()->is('another/child/route*');

$isRunningTextActive = request()->is('running-text');
$isUploadImageActive = request()->is('upload-image');
$isSlideImagesActive = request()->is('slide-images');
$isSlideJumbotronActive = request()->is('slide-jumbotron');

@endphp

<!-- Sidebar Container -->
<div x-data="{ mobileSidebarOpen: false }">

    <div x-ref="sidebar" x-show="$store.sidebar.isOpen || window.innerWidth >= 1024" :class="{
        'fixed lg:static': true,
        'shadow-lg': $store.sidebar.isOpen && window.innerWidth < 1024,
        '-translate-x-full': !$store.sidebar.isOpen && window.innerWidth < 1024,
        'translate-x-0': $store.sidebar.isOpen || window.innerWidth >= 1024
     }" @click.away="$store.sidebar.close()" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="inset-y-0 left-0 z-30 w-64 bg-stone-50 border-r border-gray-200 flex flex-col h-screen transform transition-transform duration-200 ease-in-out"
        style="will-change: transform;">

        <!-- Sidebar logo -->
        <header
            class="h-16 px-4 flex items-center justify-between bg-gradient-to-l from-stone-200 to-stone-50 border-b-1 border-stone-300">
            <a href="/" class="flex items-center">
                <img src="{{ asset('storage/images/icon/masjiid.png') }}" class="h-11" alt="Logo">
            </a>
        </header>

        <!-- Sidebar -->
        <div class="flex-1 bg-gradient-to-l from-stone-200 to-stone-50 overflow-y-auto py-3">
            <nav class="px-4 space-y-1">

                <!-- Settings Dropdown -->
                <div x-data="{ isOpen: {{ $isSettingsActive ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="isOpen = !isOpen"
                        class="flex items-center justify-between w-full px-3 py-2 rounded-md text-base font-medium
                         @if($isSettingsActive) bg-gradient-to-r from-stone-200 to bg-stone-100 text-stone-800 @else hover:bg-stone-100 @endif">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Pengaturan</span>
                        </div>
                        <svg :class="{ 'rotate-[90deg]': isOpen }" class="w-4 h-4 transition-transform origin-center"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 6l6 6l-6 6" />
                        </svg>
                    </button>

                    <!-- Submenu Items -->
                    <div x-show="isOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2" class="pl-10 space-y-1">

                        <a href="/profile" wire:navigate @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-medium
                      @if(request()->routeIs('profile')) bg-gradient-to-r from-stone-200 to bg-stone-100 text-stone-800 @else hover:bg-stone-100 @endif">
                            Profil
                        </a>

                        <a href="/praytimes" wire:navigate @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-medium
                      @if(request()->routeIs('praytimes')) bg-gradient-to-r from-stone-200 to bg-stone-100 text-stone-800 @else hover:bg-stone-100 @endif">
                            Waktu Sholat
                        </a>

                        <a href="/notification" wire:navigate
                            @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-medium
                      @if(request()->routeIs('notification')) bg-gradient-to-r from-stone-200 to bg-stone-100 text-stone-800 @else hover:bg-stone-100 @endif">
                            Notifikasi</a>

                    </div>
                </div>

                <!-- Running Text Menu (New Top-Level Menu) -->
                <a href="/running-text" wire:navigate
                    @click="openMenu = null; if (window.innerWidth < 1024) $store.sidebar.close()"
                    class="flex items-center px-3 py-2 rounded-md text-base font-medium
                    @if($isRunningTextActive) bg-gradient-to-r from-stone-200 to bg-stone-100 text-stone-800 @else hover:bg-stone-100 @endif">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                        <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                        <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                        <path d="M11 6l9 0" />
                        <path d="M11 12l9 0" />
                        <path d="M11 18l9 0" />
                    </svg>
                    <span>Teks Berjalan</span>
                </a>

                <!-- Slide Upload Images Menu (New Top-Level Menu) -->
                <a href="/upload-image" wire:navigate
                    @click="openMenu = null; if (window.innerWidth < 1024) $store.sidebar.close()"
                    class="flex items-center px-3 py-2 rounded-md text-base font-medium
                    @if($isUploadImageActive) bg-gradient-to-r from-stone-200 to bg-stone-100 text-stone-800 @else hover:bg-stone-100 @endif">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                        <path d="M9 15l3 -3l3 3" />
                        <path d="M12 12l0 9" />
                    </svg>
                    <span>Upload Gambar</span>
                </a>

                <!-- Slide Images Menu (New Top-Level Menu) -->
                <a href="/slide-images" wire:navigate
                    @click="openMenu = null; if (window.innerWidth < 1024) $store.sidebar.close()"
                    class="flex items-center px-3 py-2 rounded-md text-base font-medium
                    @if($isSlideImagesActive) bg-gradient-to-r from-stone-200 to bg-stone-100 text-stone-800 @else hover:bg-stone-100 @endif">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v4" />
                        <path d="M14 14m0 1a1 1 0 0 1 1 -1h5a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-5a1 1 0 0 1 -1 -1z" />
                        <path d="M7 9l4 4" />
                        <path d="M7 12v-3h3" />
                    </svg>
                    <span>Slide Gambar</span>
                </a>

                <!-- Slide Jumbotron Menu (New Top-Level Menu) -->
                <a href="/slide-jumbotron" wire:navigate
                    @click="openMenu = null; if (window.innerWidth < 1024) $store.sidebar.close()"
                    class="flex items-center px-3 py-2 rounded-md text-base font-medium
                    @if($isSlideJumbotronActive) bg-gradient-to-r from-stone-200 to bg-stone-100 text-stone-800 @else hover:bg-stone-100 @endif">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v4" />
                        <path d="M14 14m0 1a1 1 0 0 1 1 -1h5a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-5a1 1 0 0 1 -1 -1z" />
                    </svg>
                    <span>Slide Jumbotron</span>
                </a>

            </nav>
        </div>
    </div>

    <div x-show="$store.sidebar.isOpen && window.innerWidth < 1024" @click="$store.sidebar.close()"
        x-transition:enter="transition-opacity ease-linear duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-20 lg:hidden">
    </div>

</div>