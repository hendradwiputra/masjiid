<x-layouts.content>
    @if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
        class="flex item-center p-3 mt-2 mb-4 font-medium text-green-800 bg-green-100">
        <svg class="h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 11l3 3l8 -8" />
            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
        </svg>
        {{ session('message') }}
    </div>
    @endif

    <div class="flex items-center">
        <img src="{{ '/storage/images/icon/point.png' }}" alt="logo" class="h-5">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Pengaturan Notifikasi</h1>
    </div>

    <form wire:submit="updateNotification">
        <div class="space-y-6">
            <div class="border border-gray-200 rounded-t-2xl shadow-2xl">
                <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                    <div class="flex items-center">
                        <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 13a7 7 0 1 0 14 0a7 7 0 0 0 -14 0z" />
                            <path d="M14.5 10.5l-2.5 2.5" />
                            <path d="M17 8l1 -1" />
                            <path d="M14 3h-4" />
                        </svg>
                        <h3 class="text-base font-bold">
                            Tampilan layar ketika hitung mundur
                        </h3>
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <label for="before_adzan_label" class="block text-base font-semibold mb-2">
                            Menjelang waktu sholat
                            <p class="text-sm text-gray-700 font-light">Teks menjelang waktu sholat.</p>
                        </label>
                        <input wire:model="before_adhan_caption" type="text"
                            class="flex-1 text-base mt-1 px-2 py-3 block rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                    </div>
                    <div>
                        @error('before_adhan_caption') <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <label for="adzan_label" class="block text-base font-semibold mb-2">
                            Layar adzan
                            <p class="text-sm text-gray-700 font-light">Teks ketika adzan berkumandang.</p>
                        </label>
                        <input wire:model="adhan_caption" type="text"
                            class="flex-1 text-base mt-1 px-2 py-3 block rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                    </div>
                    <div>
                        @error('adhan_caption') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <label for="iqomah_label" class="block text-base font-semibold mb-2">
                            Layar iqomah
                            <p class="text-sm text-gray-700 font-light">Teks ketika iqomah.</p>
                        </label>
                        <input wire:model="iqomah_caption" type="text"
                            class="flex-1 text-base mt-1 px-2 py-3 block rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                    </div>
                    <div>
                        @error('iqomah_caption') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="px-4 py-5 bg-stone-100 border-t border-gray-200 mt-5">
                    <div class="flex items-center">
                        <svg class="h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12v3a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10a1 1 0 0 1 1 -1h9" />
                            <path d="M7 20l10 0" />
                            <path d="M9 16l0 4" />
                            <path d="M15 16l0 4" />
                            <path d="M17 4h4v4" />
                            <path d="M16 9l5 -5" />
                        </svg>
                        <h3 class="text-base font-bold">
                            Tampilan layar di waktu sholat
                        </h3>
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <label for="sunrise_label" class="block text-base font-semibold mb-2">
                            Layar Syuruq
                            <p class="text-sm text-gray-700 font-light">Teks di waktu Syuruq.</p>
                        </label>
                        <input wire:model="sunrise_caption" type="text"
                            class="flex-1 text-base mt-1 px-2 py-3 block rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                    </div>
                    <div>
                        @error('sunrise_caption') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <label for="prayer_label" class="block text-base font-semibold mb-2">
                            Sholat berjamaah
                            <p class="text-sm text-gray-700 font-light">Teks ketika sholat berjamaah dimulai.</p>
                        </label>
                        <input wire:model="prayer_caption" type="text"
                            class="flex-1 text-base mt-1 px-2 py-3 block rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                    </div>
                    <div>
                        @error('prayer_caption') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <label for="jumuah_label" class="block text-base font-semibold mb-2">
                            Khutbah Jum'at
                            <p class="text-sm text-gray-700 font-light">Teks ketika Khutbah Jum'at dimulai.</p>
                        </label>
                        <input wire:model="jumuah_caption" type="text"
                            class="flex-1 text-base mt-1 px-2 py-3 block rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                    </div>
                    <div>
                        @error('jumuah_caption') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="px-2 py-2 mt-3 border border-gray-200 bg-stone-100">
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <svg class="h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h10" />
                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M18 16.5v1.5l.5 .5" />
                            </svg>
                            <p class="text-sm">
                                {{ $updated_at }}
                            </p>
                        </div>
                        <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-75"
                            class="flex text-center items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4 text-base text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                            <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M14 4l0 4l-6 0l0 -4" />
                            </svg>
                            <span wire:loading.remove>Simpan</span>
                            <span wire:loading>Proses Simpan...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layouts.content>