<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/images/icon/hexagon-letter-m.svg') }}">
    <link rel="stylesheet" href="{{ asset('storage/fonts/3d643187c5/fonts.css') }}">

    <title>{{ $title ?? 'Page title' }}</title>
    @livewireStyles
    @vite('resources/css/app.css', 'resources/js/app.js')

    {{-- Loads Figtree --}}
    @googlefonts

    {{-- Loads Merriweather --}}
    @googlefonts('merriweather')

    {{-- Loads Nunito --}}
    @googlefonts('nunito')

</head>

<body>
    {{ $slot }}
    @livewireScripts
</body>

</html>