<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/images/icon/hexagon-letter-m.svg') }}">
    <title>{{ $title ?? 'Page title' }}</title>

    @vite('resources/css/app.css', 'resources/js/app.js')

</head>

<body>
    <!-- ===== Preloader Start ===== -->
    <div>
        <div x-show="loaded"
            x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
            class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-gradient-to-b from-stone-900 to bg-stone-400">
            <div
                class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-amber-400 border-t-transparent">
            </div>
        </div>
    </div>
    <!-- ===== Preloader End ===== -->

    {{ $slot }}

</body>

</html>