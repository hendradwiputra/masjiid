<div>
    @if (session()->has('error'))
    <div class="bg-red-50 text-center text-red-500 px-4 py-2 rounded-md relative mt-4" role="alert">
        <strong class="font-bold tracking-wide">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif
</div>