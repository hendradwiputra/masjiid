<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- googlefonts --}}
    @googlefonts

    @googlefonts('merriweather')

    @livewireStyles
</head>

<body class="bg-stone-50">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <!-- Overlay when sidebar is open (mobile) -->
        <div x-show="sidebarOpen" x-cloak
            class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 md:hidden transition-opacity duration-300"
            @click="sidebarOpen = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <x-sidebar />

        <main class="flex-1 overflow-auto p-4 md:p-6">
            <x-content>
                {{ $slot }}
            </x-content>
        </main>

    </div>

    @livewireScripts
</body>

</html>