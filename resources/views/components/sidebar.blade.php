<div x-cloak @click.away="sidebarOpen = false"
    :class="sidebarOpen ? 'fixed inset-y-0 left-0 z-40 flex' : 'hidden md:flex'"
    class="w-72 min-h-screen bg-linear-to-b from-slate-900 to-slate-800 text-slate-100 flex flex-col transition-all duration-300 ease-in-out">

    {{-- Brand --}}
    <div class="px-5 py-6 border-b border-slate-700/50">
        <div class="flex items-center gap-3">
            <div class="flex items-center justify-center shadow-lg shadow-blue-500/25 rounded-xl">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Logo"
                    class="bg-slate-100 p-1 rounded-xl w-11 h-11" />
            </div>
            <div>
                <h1 class="text-xl font-extrabold tracking-wider">
                    Masjiid
                    <span class="text-slate-300 text-xs font-extralight">v1.3</span>
                </h1>
                <p class="text-xs text-slate-400 font-light tracking-wide">Masjid Management System</p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        @foreach ($menus as $menu)
        @if (isset($menu['children']))

        {{-- Parent with children --}}
        <div x-data="{ open: {{ $menu['isActive'] ? 'true' : 'false' }} }">
            <button @click="open = !open"
                @class([ 'w-full flex items-center justify-between gap-3 px-4 py-3 rounded-3xl transition-all duration-200 group'
                , 'bg-gradient-to-r from-blue-500 to-blue-700 shadow-lg shadow-blue-500/20'=>
                $menu['isActive'],
                'hover:bg-slate-800/80 text-slate-300 hover:text-white' => !$menu['isActive'],
                ])>
                <div class="flex items-center gap-3">
                    <span class="text-current opacity-70 group-hover:opacity-100 transition-opacity">
                        @if(is_array($menu['icon']) && $menu['icon']['type'] === 'component')
                        <x-dynamic-component :component="$menu['icon']['component']" class="w-5 h-5" />
                        @endif
                    </span>
                    <span class="font-medium text-sm tracking-wide">{{ $menu['label'] }}</span>
                </div>

                <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            {{-- Children --}}
            <div x-show="open" x-collapse.duration.300ms class="mt-1 ml-6 space-y-1 border-slate-700/50 pl-2">
                @foreach ($menu['children'] as $child)
                <a href="{{ route($child['route']) }}" wire:navigate
                    @class([ 'block px-4 py-2 rounded-3xl text-sm transition-all duration-200 group'
                    , 'bg-gradient-to-r from-blue-500 to-blue-700 text-white shadow-md shadow-blue-500/20'=>
                    $child['isActive'],
                    'hover:bg-slate-800/60 text-slate-400 hover:text-white' => !$child['isActive'],
                    ])>
                    <span class="flex items-center tracking-wide gap-2">
                        {{ $child['label'] }}
                    </span>
                </a>
                @endforeach
            </div>
        </div>
        @else

        {{-- Normal menu item --}}
        <a href="{{ route($menu['route']) }}" wire:navigate
            @class([ 'flex items-center gap-3 px-4 py-2 rounded-3xl transition-all duration-200 group'
            , 'bg-gradient-to-r from-blue-500 to-blue-700 text-white shadow-lg shadow-blue-500/20'=>
            $menu['isActive'],
            'hover:bg-slate-800/80 text-slate-300 hover:text-white py-3' => !$menu['isActive'],
            ])>
            <span class="text-current opacity-70 group-hover:opacity-100 transition-opacity">
                @if(is_array($menu['icon']) && $menu['icon']['type'] === 'component')
                <x-dynamic-component :component="$menu['icon']['component']" class="w-5 h-5" />
                @endif
            </span>
            <span class="font-medium text-sm tracking-wide">{{ $menu['label'] }}</span>
            @if($menu['isActive'])
            <span class="ml-auto w-1.5 h-8 rounded-full bg-white/50"></span>
            @endif
        </a>
        @endif
        @endforeach
    </nav>

    {{-- User menu --}}
    <div class="px-4 py-2 border-t border-slate-700/50 bg-slate-800/30">
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-800/60 transition-all duration-200 text-left group">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-linear-to-br from-blue-500 to-blue-700 flex items-center justify-center text-sm font-semibold text-white shadow-lg shadow-blue-500/20">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-slate-100 truncate">{{ auth()->user()->name ?? 'User' }}
                        </div>
                        <div class="text-xs text-slate-400 truncate">{{ auth()->user()->email ?? '' }}</div>
                    </div>
                </div>
                <svg class="w-4 h-4 text-slate-400 transition-transform duration-300 group-hover:text-white"
                    :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                class="absolute left-0 bottom-full mb-2 w-full bg-slate-800 rounded-xl shadow-2xl border border-slate-700/50 overflow-hidden z-20">
                <a wire:navigate href="{{ route('settings.users.edit', auth()->user()->id) }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                    <x-heroicon-o-user-circle class="w-4 h-4" />
                    Edit Profil
                </a>
                <livewire:pages::logout />
            </div>
        </div>
    </div>
</div>