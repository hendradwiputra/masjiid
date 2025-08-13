<div class="font-mavenpro">
    <div class="flex h-screen overflow-hidden">

        @include('livewire.layouts.sidebar')

        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Mobile header -->
            <div
                class="h-16 flex sticky top-0 items-center justify-between px-4 border-b border-gray-200 bg-white lg:hidden">
                <button id="mobileSidebarToggle" class="p-1 rounded-md hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#374151"
                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <path d="M4 6l16 0" />
                        <path d="M4 12l10 0" />
                        <path d="M4 18l14 0" />
                    </svg>
                </button>
                <a href="/" class="flex items-center text-2xl font-semibold text-rose-600 lg:block">
                    <img src="{{ asset('storage/images/icon/masjiid.png') }}" class="h-12" alt="">
                </a>
                <button id="mobileHeaderToggle" class="p-1 rounded-md hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#374151"
                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    </svg>
                </button>
            </div>

            <!-- Mobile expanded header (hidden by default) -->
            <div id="mobileHeader" class="lg:hidden hidden bg-white border-b border-gray-200 px-4 py-3">
                <div class="flex items-center justify-end space-x-4">
                    <div class="flex items-center space-x-3">
                        <!-- User profile dropdown -->
                        <div class="relative">
                            <button id="mobileProfileButton"
                                class="flex items-center text-sm font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100">
                                <img class="h-8 w-8 rounded-full" src="{{ 'storage/images/icon/user-circle.png'}}"
                                    alt="user">
                                <span class="ml-2 text-gray-700 hidden md:inline">{{ Auth::user()->name }}</span>
                                <svg class="ml-1 h-4 w-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                    stroke="#374151" stroke-width="1">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>

                            <div id="mobileProfileDropdown"
                                class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-gray-100 ring-opacity-5 focus:outline-none z-50">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your
                                    Profile</a>
                                <livewire:auth.logout />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop header -->
            <div
                class="hidden lg:flex sticky top-0 items-center justify-end h-16 px-6 border-b border-gray-200 bg-white">
                <div class="flex items-center space-x-4">
                    <!-- User profile dropdown -->
                    <div class="relative ml-3">
                        <button id="profileButton"
                            class="flex items-center max-w-xs text-sm font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100">
                            <img class="h-8 w-8 rounded-full" src="{{ 'storage/images/icon/user-circle.png'}}"
                                alt="user">
                            <span class="ml-2 hidden md:inline">{{ Auth::user()->name }}</span>
                            <svg class="ml-1 h-4 w-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                stroke="#374151" stroke-width="1.25">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <div id="profileDropdown"
                            class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-gray-100 ring-opacity-5 focus:outline-none z-50">
                            <a href="#" class="flex items-center px-2 py-2 gap-2 text-sm hover:bg-blue-100">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#000000"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
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

            <!-- Content area -->
            <div class="p-6 pt-2">

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');

        mobileSidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });

        // Toggle mobile header
        const mobileHeaderToggle = document.getElementById('mobileHeaderToggle');
        const mobileHeader = document.getElementById('mobileHeader');

        mobileHeaderToggle.addEventListener('click', () => {
            mobileHeader.classList.toggle('hidden');
        });

        // Toggle projects submenu
        const projectsMenu = document.getElementById('projectsMenu');
        const projectsSubmenu = document.getElementById('projectsSubmenu');
        const projectsMenuArrow = document.getElementById('projectsMenuArrow');

        projectsMenu.addEventListener('click', () => {
            projectsSubmenu.classList.toggle('hidden');
            projectsSubmenu.classList.toggle('open');
            projectsMenuArrow.classList.toggle('rotate-90');
        });

        // Toggle profile dropdown (desktop)
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileButton && profileDropdown) {
            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        }

        // Toggle mobile profile dropdown
        const mobileProfileButton = document.getElementById('mobileProfileButton');
        const mobileProfileDropdown = document.getElementById('mobileProfileDropdown');

        if (mobileProfileButton && mobileProfileDropdown) {
            mobileProfileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileProfileDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileProfileButton.contains(e.target) && !mobileProfileDropdown.contains(e.target)) {
                    mobileProfileDropdown.classList.add('hidden');
                }
            });
        }

    </script>

</div>