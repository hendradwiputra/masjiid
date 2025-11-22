@php
$isSettingsActive = request()->is('settings/profile') ||
request()->is('settings/praytimes*') ||
request()->is('settings/notification') ||
request()->is('another/child/route*');

$isRunningTextActive = request()->is('running-text');
$isUploadImageActive = request()->is('upload-image');
$isSlideImagesActive = request()->is('slide-images');

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
        class="inset-y-0 left-0 z-30 w-64 bg-stone-50 flex flex-col h-screen transform transition-transform duration-200 ease-in-out"
        style="will-change: transform;">

        <!-- Sidebar logo -->
        <header class="h-16 px-4 flex items-center justify-between bg-gray-50 ">
            <a href="/" class="flex items-center">
                <img src="{{ asset('storage/images/icon/masjiid.png') }}" class="h-11" alt="Logo">
            </a>
        </header>

        <!-- Sidebar -->
        <div class="flex-1 bg-gray-50 overflow-y-auto py-3">
            <nav class="px-4 space-y-1">

                <!-- Settings Dropdown -->
                <div x-data="{ isOpen: {{ $isSettingsActive ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="isOpen = !isOpen"
                        class="flex items-center justify-between w-full px-3 py-2 rounded-md text-base font-semibold
                         @if($isSettingsActive) bg-blue-600 text-white @else hover:bg-blue-50 hover:text-blue-600 @endif">
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

                        <a href="/settings/profile" wire:navigate
                            @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-semibold
                      @if(request()->routeIs('profile')) bg-blue-600 text-white @else hover:bg-blue-50 hover:text-blue-600 @endif">
                            Profil
                        </a>

                        <a href="/settings/praytimes" wire:navigate
                            @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-semibold
                      @if(request()->routeIs('praytimes')) bg-blue-600 text-white @else hover:bg-blue-50 hover:text-blue-600 @endif">
                            Waktu Sholat
                        </a>

                        <a href="/settings/notification" wire:navigate
                            @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-semibold
                      @if(request()->routeIs('notification')) bg-blue-600 text-white @else hover:bg-blue-50 hover:text-blue-600 @endif">
                            Notifikasi</a>

                    </div>
                </div>

                <!-- Running Text Menu (New Top-Level Menu) -->
                <a href="/running-text" wire:navigate
                    @click="openMenu = null; if (window.innerWidth < 1024) $store.sidebar.close()"
                    class="flex items-center px-3 py-2 rounded-md text-base font-semibold
                    @if($isRunningTextActive) bg-blue-600 text-white @else hover:bg-blue-50 hover:text-blue-600 @endif">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M9 9l1 0" />
                        <path d="M9 13l6 0" />
                        <path d="M9 17l6 0" />
                    </svg>
                    <span>Teks Berjalan</span>
                </a>

                <!-- Slide Upload Images Menu (New Top-Level Menu) -->
                <a href="/upload-image" wire:navigate
                    @click="openMenu = null; if (window.innerWidth < 1024) $store.sidebar.close()"
                    class="flex items-center px-3 py-2 rounded-md text-base font-semibold
                    @if($isUploadImageActive) bg-blue-600 text-white @else hover:bg-blue-50 hover:text-blue-600 @endif">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                        <path d="M9 15l3 -3l3 3" />
                        <path d="M12 12l0 9" />
                    </svg>
                    <span>Unggah Media</span>
                </a>

                <!-- Slide Images Menu (New Top-Level Menu) -->
                <a href="/slide-images" wire:navigate
                    @click="openMenu = null; if (window.innerWidth < 1024) $store.sidebar.close()"
                    class="flex items-center px-3 py-2 rounded-md text-base font-semibold
                    @if($isSlideImagesActive) bg-blue-600 text-white @else hover:bg-blue-50 hover:text-blue-600 @endif">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v4" />
                        <path d="M14 14m0 1a1 1 0 0 1 1 -1h5a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-5a1 1 0 0 1 -1 -1z" />
                        <path d="M7 9l4 4" />
                        <path d="M7 12v-3h3" />
                    </svg>
                    <span>Slide Gambar</span>
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