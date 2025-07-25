@php
    $isSettingsActive = request()->is('profile*') || request()->is('praytimes*') || request()->is('another/child/route*');  
@endphp

<!-- Sidebar -->
<div id="sidebar" class="sidebar-transition bg-stone-200 w-64 flex-shrink-0 border-r border-gray-200 flex flex-col">
    <!-- Sidebar header -->
    <div class="h-16 flex items-center justify-center border-b border-gray-50">

        <a href="/" class="flex items-center text-2xl font-semibold text-rose-600 lg:block">
            <img src="{{ asset('storage/images/icon/masjiid.png') }}" class="h-10" alt="">
        </a>
        
        <button id="sidebarToggle" class="p-1 rounded-md hover:bg-gray-100 lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    
    <!-- Sidebar content -->
    <div class="flex-1 overflow-y-auto">
        <nav class="px-2 py-4">
            <div class="space-y-1.5">
                <!-- Dashboard -->
                <a href="/dashboard" class="flex items-center px-2 py-3 text-sm font-medium rounded-md group hover:bg-stone-50 hover:text-slate-900 text-slate-700
                    @if(request()->routeIs('dashboard')) bg-stone-300 @endif">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#334155"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="mr-3"
                        >
                        <path d="M19 8.71l-5.333 -4.148a2.666 2.666 0 0 0 -3.274 0l-5.334 4.148a2.665 2.665 0 0 0 -1.029 2.105v7.2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-7.2c0 -.823 -.38 -1.6 -1.03 -2.105" />
                        <path d="M16 15c-2.21 1.333 -5.792 1.333 -8 0" />
                    </svg>
                    <span class="lg:block">Dashboard</span>
                </a>
                                        
                <!-- Settings With submenu -->
                <div class="group space-y-1.5">
                    <button id="projectsMenu" class="flex items-center justify-between w-full px-2 py-3 text-sm font-medium rounded-md hover:bg-stone-50 hover:text-slate-900 text-slate-700
                        {{ $isSettingsActive ? 'bg-stone-50' : '' }}">
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#334155"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="mr-3"
                                >
                                <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                            </svg>
                            <span class="lg:block">Settings</span>
                        </div>
                        <svg id="projectsMenuArrow" class="h-4 w-4 lg:block transform transition-transform {{ $isSettingsActive ? 'rotate-180' : '' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <div id="projectsSubmenu" class="submenu pl-4 ml-6 space-y-1.5 border-l border-gray-200 {{ $isSettingsActive ? 'open' : 'hidden' }}">
                        <a href="/profile" class="flex items-center px-2 py-2 text-sm font-medium rounded-md group hover:bg-stone-50 hover:text-slate-900 text-slate-700
                            @if(request()->routeIs('profile')) bg-stone-300 @endif">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#334155"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="mr-3"
                                >
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                            <span class="lg:block">Profile</span>
                        </a>
                        <a href="/praytimes" class="flex items-center px-2 py-2 text-sm font-medium rounded-md group hover:bg-stone-50 hover:text-slate-900 text-slate-700
                            @if(request()->routeIs('praytimes')) bg-stone-300 @endif">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#334155"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="mr-3"
                                >
                                <path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h10" />
                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M18 16.5v1.5l.5 .5" />
                            </svg>
                            <span class="lg:block">Praytimes</span>
                        </a>
                        
                    </div>
                </div>                
                
            </div>
        </nav>
    </div>
    
    <!-- Profile section with dropdown -->
    <div class="p-4 border-t border-gray-50 relative">
        <button id="profileButton" class="w-full flex items-center focus:outline-none">            
            <div class="ml-3 lg:block text-left">
                <p class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-xs font-medium text-gray-500">View Profile</p>
            </div>
            <svg class="ml-auto lg:block h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
        
        <!-- Profile dropdown menu -->
        <div id="profileDropdown" class="profile-dropdown px-1 bg-stone-50 rounded-md shadow-lg py-1 z-50">
            <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-stone-200 rounded-md">Your Profile</a>
            <div class="border-t border-gray-200"></div>
            <livewire:auth.logout />            
        </div>
    </div>
</div>
<!-- Sidebar End -->
