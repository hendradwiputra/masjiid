<div class="font-mavenpro">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div wire:ignore>
            <x-layouts.sidebar></x-layouts.sidebar>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Navbar -->
            <x-layouts.navbar></x-layouts.navbar>

            <!-- Page Content -->
            <div class="min-h-screen p-6 pt-0 mb-2">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <x-layouts.footer></x-layouts.footer>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('sidebar', {
            isOpen: window.innerWidth < 1024 ? false : true,
            activeSubmenu: null, // Track which submenu is open
            
            open() {
                this.isOpen = true;
            },
            
            close() {
                if (window.innerWidth < 1024) {
                    this.isOpen = false;
                }
                this.activeSubmenu = null; // Close all submenus when sidebar closes
            },
            
            toggle() {
                if (window.innerWidth < 1024) {
                    this.isOpen = !this.isOpen;
                    if (!this.isOpen) this.activeSubmenu = null;
                }
            },
            
            handleResize() {
                this.isOpen = window.innerWidth >= 1024;
                if (!this.isOpen) this.activeSubmenu = null;
            },
            
            // New methods for submenu handling
            toggleSubmenu(menuId) {
                if (this.activeSubmenu === menuId) {
                    this.activeSubmenu = null;
                } else {
                    this.activeSubmenu = menuId;
                    // Ensure sidebar is open when opening submenu on mobile
                    if (window.innerWidth < 1024 && !this.isOpen) {
                        this.isOpen = true;
                    }
                }
            },
            
            closeSubmenus() {
                this.activeSubmenu = null;
            }
        });

        // Initialize responsive behavior
        window.addEventListener('resize', () => {
            Alpine.store('sidebar').handleResize();
        });
    });
</script>