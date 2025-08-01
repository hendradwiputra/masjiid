@php
$isSettingsActive = request()->is('profile*') || request()->is('praytimes*') || request()->is('another/child/route*');
@endphp

<!-- Sidebar -->
<div id="sidebar" class="sidebar-transition bg-white w-64 flex-shrink-0 border-r border-gray-200 flex flex-col">
    <!-- Sidebar header -->
    <div class="h-16 px-2 flex items-center border-b border-gray-200">
        <a href="/" class="flex items-center text-2xl font-semibold text-rose-600 hidden lg:block">
            <img src="{{ asset('storage/images/icon/masjiid.png') }}" class="h-12" alt="logo">
        </a>
        <button id="sidebarToggle" class="p-1 rounded-md hover:bg-gray-100 lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.25"
                stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8">
                <path d="M18 6l-12 12" />
                <path d="M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar content -->
    <div class="flex-1 overflow-y-auto">
        <nav class="px-2 py-4">
            <div class="space-y-1.5">
                <!-- Dashboard -->
                <a href="/dashboard" class="flex items-center px-2 py-3 text-sm font-medium rounded-md group hover:bg-blue-100
                    @if(request()->routeIs('dashboard')) bg-blue-100 @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#334155" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-4">
                        <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                        <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />
                        <path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" />
                        <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" />
                    </svg>

                    <span class="lg:block">Dasbor</span>
                </a>

                <!-- Settings With submenu -->
                <div class="group space-y-1.5">
                    <button id="projectsMenu" class="flex items-center justify-between w-full px-2 py-3 text-sm font-medium rounded-md hover:bg-blue-100
                        {{ $isSettingsActive ? 'bg-blue-100' : '' }}">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#334155" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="mr-4">
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                            </svg>
                            <span class="lg:block">Settings</span>
                        </div>
                        <svg id="projectsMenuArrow"
                            class="h-4 w-4 lg:block transform transition-transform {{ $isSettingsActive ? 'rotate-180' : '' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="projectsSubmenu"
                        class="submenu pl-4 ml-6 space-y-1.5 border-l border-gray-200 {{ $isSettingsActive ? 'open' : 'hidden' }}">
                        <a href="/profile" class="flex items-center px-2 py-2 text-sm font-medium rounded-md group hover:bg-blue-100
                            @if(request()->routeIs('profile')) bg-blue-100 @endif">
                            <span class="lg:block">Profil</span>
                        </a>
                        <a href="/praytimes" class="flex items-center px-2 py-2 text-sm font-medium rounded-md group hover:bg-blue-100
                            @if(request()->routeIs('praytimes')) bg-blue-100 @endif">
                            <span class="lg:block">Waktu Sholat</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Sidebar End -->