<x-layouts.content>
    <x-session-message />

    <!-- Header -->
    <div class="flex items-center mb-8">
        <img src="{{ '/storage/images/icon/point.png' }}" alt="logo" class="h-5">
        <h1 class="text-xl font-semibold text-gray-800 ml-2">Pengaturan Notifikasi</h1>
    </div>

    <form wire:submit="updateNotification">
        <div class="space-y-6">
            <!-- Countdown Display Settings -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M5 13a7 7 0 1 0 14 0a7 7 0 0 0 -14 0z" />
                            <path d="M14.5 10.5l-2.5 2.5" />
                            <path d="M17 8l1 -1" />
                            <path d="M14 3h-4" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Tampilan Hitung Mundur
                        </h3>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Pengaturan teks yang ditampilkan selama hitung mundur sholat
                    </p>
                </div>

                <!-- Before Adhan -->
                <div class="p-6 border-b border-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                        <div class="lg:col-span-1">
                            <label class="block text-base font-semibold text-gray-900 mb-1">
                                Menjelang Waktu Sholat
                            </label>
                            <p class="text-sm text-gray-600">Teks yang muncul sebelum adzan berkumandang</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input wire:model="before_adhan_caption" type="text"
                                placeholder="Contoh: Menuju Waktu Sholat..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('before_adhan_caption')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Adhan -->
                <div class="p-6 border-b border-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                        <div class="lg:col-span-1">
                            <label class="block text-base font-semibold text-gray-900 mb-1">
                                Layar Adzan
                            </label>
                            <p class="text-sm text-gray-600">Teks ketika adzan sedang berkumandang</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input wire:model="adhan_caption" type="text" placeholder="Contoh: Adzan Berkumandang..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('adhan_caption')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Iqomah -->
                <div class="p-6 border-b border-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                        <div class="lg:col-span-1">
                            <label class="block text-base font-semibold text-gray-900 mb-1">
                                Layar Iqomah
                            </label>
                            <p class="text-sm text-gray-600">Teks ketika iqomah dikumandangkan</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input wire:model="iqomah_caption" type="text"
                                placeholder="Contoh: Iqomah Dikumandangkan..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('iqomah_caption')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prayer Time Display Settings -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M21 12v3a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1v-10a1 1 0 0 1 1 -1h9" />
                            <path d="M7 20l10 0" />
                            <path d="M9 16l0 4" />
                            <path d="M15 16l0 4" />
                            <path d="M17 4h4v4" />
                            <path d="M16 9l5 -5" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Tampilan Waktu Sholat
                        </h3>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Pengaturan teks yang ditampilkan selama waktu sholat
                        berlangsung</p>
                </div>

                <!-- Sunrise -->
                <div class="p-6 border-b border-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                        <div class="lg:col-span-1">
                            <label class="block text-base font-semibold text-gray-900 mb-1">
                                Layar Syuruq
                            </label>
                            <p class="text-sm text-gray-600">Teks yang ditampilkan di waktu Syuruq</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input wire:model="sunrise_caption" type="text" placeholder="Contoh: Waktu Syuruq..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('sunrise_caption')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Prayer -->
                <div class="p-6 border-b border-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                        <div class="lg:col-span-1">
                            <label class="block text-base font-semibold text-gray-900 mb-1">
                                Sholat Berjamaah
                            </label>
                            <p class="text-sm text-gray-600">Teks ketika sholat berjamaah dimulai</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input wire:model="prayer_caption" type="text"
                                placeholder="Contoh: Sholat Berjamaah Dimulai..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('prayer_caption')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Jumuah -->
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                        <div class="lg:col-span-1">
                            <label class="block text-base font-semibold text-gray-900 mb-1">
                                Khutbah Jum'at
                            </label>
                            <p class="text-sm text-gray-600">Teks ketika Khutbah Jum'at dimulai</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input wire:model="jumuah_caption" type="text"
                                placeholder="Contoh: Khutbah Jum'at Dimulai..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('jumuah_caption')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                        <div class="flex items-center text-sm text-gray-500">
                            <x-modified-date :updated_at="$updated_at" />
                        </div>
                        <div class="flex space-x-3">
                            <button type="submit" wire:loading.attr="disabled"
                                wire:loading.class="opacity-75 cursor-not-allowed"
                                class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span wire:loading.remove>Simpan Pengaturan</span>
                                <span wire:loading>Menyimpan...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layouts.content>