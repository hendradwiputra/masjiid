@props(['contentClass' => 'p-6 pt-0 mb-2'])

<div class="font-mavenpro min-h-screen">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="shrink-0 w-64 fixed top-0 h-screen transition-transform duration-300 ease-in-out lg:sticky lg:translate-x-0 z-20 bg-white"
            x-bind:class="{ 
                'translate-x-0 w-64': $store.sidebar.isOpen, 
                '-translate-x-full w-0': !$store.sidebar.isOpen && window.innerWidth < 1024 
            }" wire:ignore>
            <x-layouts.sidebar />
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col transition-all duration-300 ease-in-out"
            x-bind:class="{ 'ml-0 w-full': !$store.sidebar.isOpen && window.innerWidth < 1024 }">
            <!-- Navbar -->
            <header class="shrink-0 sticky top-0 z-10 bg-white">
                <x-layouts.navbar />
            </header>

            <!-- Page Content -->
            <main class="{{ $contentClass }} flex-1 overflow-y-auto w-full" wire:key="page-content">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="shrink-0">
                <x-layouts.footer />
            </footer>
        </div>
    </div>
</div>

{{-- Alpine store/init (guarded so it only registers once) --}}
<script>
    (function(){
        if (window.__sidebarInit) return;
        window.__sidebarInit = true;

        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                isOpen: window.innerWidth >= 1024,
                activeSubmenu: null,
                open() { 
                    this.isOpen = true; 
                },
                close() {
                    if (window.innerWidth < 1024) {
                        this.isOpen = false;
                        this.activeSubmenu = null;
                    }
                },
                toggle() {
                    this.isOpen = !this.isOpen;
                    if (!this.isOpen) this.activeSubmenu = null;
                },
                handleResize() {
                    this.isOpen = window.innerWidth >= 1024;
                    if (!this.isOpen) this.activeSubmenu = null;
                },
                toggleSubmenu(menuId) {
                    this.activeSubmenu = this.activeSubmenu === menuId ? null : menuId;
                    if (window.innerWidth < 1024 && !this.isOpen) this.open();
                },
                closeSubmenus() { 
                    this.activeSubmenu = null; 
                }
            });
        });

        // Debounced resize event for smooth transitions
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                const s = Alpine.store('sidebar');
                if (s && typeof s.handleResize === 'function') s.handleResize();
            }, 100);
        });
    })();
</script>