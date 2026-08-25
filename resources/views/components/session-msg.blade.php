@if (session()->has('success'))
<div class="flex justify-end">
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3500)" x-show="show" x-transition
        class="fixed top-4 z-50 gap-2 bg-green-50 text-green-800 text-sm border border-green-800 px-4 py-2 rounded-xl">
        <div class="flex items-start gap-2">
            <x-heroicon-o-check-circle class="w-6 h-6 inline-block text-green-800" />
            <div class="font-semibold text-gray-900">
                <strong>Berhasil</strong>
                <p class="text-gray-600 font-light">{{ session('success') }}</p>
            </div>
        </div>
    </div>
</div>
@endif