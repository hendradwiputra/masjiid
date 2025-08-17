<!-- Navbar Container -->
<div x-data="{ mobileSidebarOpen: false, mobileHeaderOpen: false }">
    <!-- Mobile header -->
    <div
        class="h-16 flex sticky top-0 z-40 items-center justify-between px-4 border-b border-gray-200 bg-white lg:hidden">

        <!-- Sidebar toggle button -->
        <button @click="$store.sidebar.toggle()" class="p-1 rounded-md hover:bg-gray-100">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                stroke-linejoin="round" class="h-6 w-6 text-gray-700">
                <path d="M4 6l16 0" />
                <path d="M4 12l10 0" />
                <path d="M4 18l14 0" />
            </svg>
        </button>

        <!-- Logo -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('storage/images/icon/masjiid.png') }}" class="h-10" alt="">
        </a>

        <!-- Profile toggle button -->
        <button @click="mobileHeaderOpen = !mobileHeaderOpen" class="p-1 rounded-md hover:bg-gray-100">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                stroke-linejoin="round" class="h-6 w-6 text-gray-700">
                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
            </svg>
        </button>

    </div>

    <!-- Navbar in mobile mode -->
    <div x-show="mobileHeaderOpen" @click.away="mobileHeaderOpen = false"
        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="lg:hidden bg-gray-100 border-b border-gray-200 px-4 py-3 sticky top-16 z-30">
        <div class="flex items-center justify-end space-x-4">
            <div class="flex items-center space-x-3">
                <!-- User profile dropdown -->
                <div class="relative" x-data="{ mobileProfileOpen: false }">
                    <button @click="mobileProfileOpen = !mobileProfileOpen"
                        class="flex items-center text-sm font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100">
                        <img class="h-8 w-8 rounded-full" src="{{ 'storage/images/icon/user-circle.png'}}" alt="user">
                        <span class="ml-2 mr-2 text-gray-700">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transition-transform origin-center" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6l6 -6" />
                        </svg>
                    </button>

                    <div x-show="mobileProfileOpen" @click.away="mobileProfileOpen = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-gray-100 ring-opacity-5 focus:outline-none z-40">
                        <a href="#" class="flex items-center px-2 py-2 gap-2 text-sm hover:bg-blue-100">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                                stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                            </svg>
                            Your Profile
                        </a>
                        <livewire:auth.logout />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar in desktop mode -->
    <div class="hidden lg:flex sticky top-0 items-center justify-end h-16 px-6 border-b border-gray-200 bg-white z-40">
        <div class="flex items-center space-x-4">
            <!-- User profile dropdown -->
            <div class="relative ml-3" x-data="{ profileOpen: false }">
                <button @click="profileOpen = !profileOpen"
                    class="flex items-center max-w-xs text-sm font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100">
                    <img class="h-8 w-8 rounded-full" src="{{ 'storage/images/icon/user-circle.png'}}" alt="user">
                    <span class="ml-2 mr-2">{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 transition-transform origin-center" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 9l6 6l6 -6" />
                    </svg>
                </button>

                <div x-show="profileOpen" @click.away="profileOpen = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-gray-100 ring-opacity-5 focus:outline-none z-50">
                    <a href="#" class="flex items-center px-2 py-2 gap-2 text-sm hover:bg-blue-100">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                        </svg>
                        Your Profile
                    </a>
                    <livewire:auth.logout />
                </div>
            </div>
        </div>
    </div>