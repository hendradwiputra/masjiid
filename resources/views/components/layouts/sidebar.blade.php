@php
$isSettingsActive = request()->is('profile*') ||
request()->is('praytimes*') ||
request()->is('upload-image') ||
request()->is('notification') ||
request()->is('running-text') ||
request()->is('another/child/route*');
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
        <header class="h-16 px-4 flex items-center justify-between">
            <a href="/" class="flex items-center">
                <img src="{{ asset('storage/images/icon/masjiid.png') }}" class="h-11" alt="Logo">
            </a>
        </header>

        <!-- Sidebar -->
        <div class="flex-1 bg-stone-50 overflow-y-auto py-4">
            <nav class="px-4 space-y-2">

                <!-- Dashboard Link -->
                <a href="/dashboard" wire:navigate @click="if (window.innerWidth < 1024) $store.sidebar.close()" class="flex items-center px-3 py-3 rounded-md text-base font-medium
                  @if(request()->routeIs('dashboard')) bg-stone-200 text-stone-800 @else hover:bg-stone-100 @endif">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M13.45 11.55l2.05 -2.05" />
                        <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                    </svg>
                    <span>Dasbor</span>
                </a>

                <!-- Settings Dropdown -->
                <div x-data="{ isOpen: {{ $isSettingsActive ? 'true' : 'false' }} }" class="space-y-1">
                    <button @click="isOpen = !isOpen" class="flex items-center justify-between w-full px-3 py-3 rounded-md text-base font-medium
                         @if($isSettingsActive) bg-stone-200 text-stone-800 @else hover:bg-stone-100 @endif">
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
                      @if(request()->routeIs('profile')) bg-stone-200 text-stone-800 @else hover:bg-stone-100 @endif">
                            Profil
                        </a>

                        <a href="/praytimes" wire:navigate @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-medium
                      @if(request()->routeIs('praytimes')) bg-stone-200 text-stone-800 @else hover:bg-stone-100 @endif">
                            Waktu Sholat
                        </a>

                        <a href="/notification" wire:navigate
                            @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-medium
                      @if(request()->routeIs('notification')) bg-stone-200 text-stone-800 @else hover:bg-stone-100 @endif">
                            Notifikasi</a>

                        <a href="/running-text" wire:navigate
                            @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-medium
                      @if(request()->routeIs('running-text')) bg-stone-200 text-stone-800 @else hover:bg-stone-100 @endif">
                            Teks Berjalan</a>

                        <a href="/upload-image" wire:navigate
                            @click="if (window.innerWidth < 1024) $store.sidebar.close()"
                            class="block px-3 py-2 rounded-md text-base font-medium
                      @if(request()->routeIs('upload-image')) bg-stone-200 text-stone-800 @else hover:bg-stone-100 @endif">
                            Upload</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div x-show="$store.sidebar.isOpen && window.innerWidth < 1024" @click="$store.sidebar.close()"
        x-transition:enter="transition-opacity ease-linear duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-20 lg:hidden">
    </div>

</div>