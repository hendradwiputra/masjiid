<div class="bg-stone-50 font-mavenpro">
    <div class="flex h-screen overflow-hidden">

        @include('livewire.layouts.sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Mobile header -->
            <div class="h-16 flex items-center justify-between px-4 border-b border-gray-200 bg-white lg:hidden">
                <button id="mobileSidebarToggle" class="p-1 rounded-md hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <a href="/" class="flex items-center text-2xl font-semibold text-rose-600 lg:block">
                    <img src="{{ asset('storage/images/icon/masjiid.png') }}" class="h-6" alt="">
                </a>
                <div class="w-6"></div> <!-- Spacer for alignment -->
            </div>
            
            <!-- Content area -->
            <div class="p-6 pt-9">
                <h1 class="text-2xl font-semibold text-gray-800">{{ $pageTitle }}</h1>
                <p class="mt-1 text-sm text-gray-600">{{ $subTitle }}</p>
                
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

        // Toggle projects submenu
        const projectsMenu = document.getElementById('projectsMenu');
        const projectsSubmenu = document.getElementById('projectsSubmenu');
        const projectsMenuArrow = document.getElementById('projectsMenuArrow');

        projectsMenu.addEventListener('click', () => {
            projectsSubmenu.classList.toggle('hidden');
            projectsSubmenu.classList.toggle('open');
            projectsMenuArrow.classList.toggle('rotate-90');
        });

        // Toggle profile dropdown
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileButton && profileDropdown) {
            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', () => {
                profileDropdown.classList.remove('show');
            });
        }        

    </script>

</div>
