@php
$pageTitle = $title ?? \App\View\Components\Sidebar::currentLabel();
@endphp

<div>
    <h1 class="text-xl md:text-2xl font-bold text-gray-800">
        {{ $pageTitle }}
    </h1>
</div>