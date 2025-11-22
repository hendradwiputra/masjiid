<x-layouts.content>
    <x-session-message />

    <form wire:submit="update">
        <!-- Header -->
        <div class="flex items-center mb-6 mt-6">
            <img src="{{ '/storage/images/icon/point.png' }}" class="h-5" alt="logo">
            <h1 class="text-xl font-semibold text-gray-800 ml-2">Konfigurasi Waktu Sholat</h1>
        </div>

        <!-- Location & Time Settings -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
            <!-- Coordinates Card -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0" />
                            <path d="M12 2l0 2" />
                            <path d="M12 20l0 2" />
                            <path d="M20 12l2 0" />
                            <path d="M2 12l2 0" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Koordinat Lokasi</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label for="latitude" class="block text-base font-semibold text-gray-900 mb-3">Garis Lintang
                            (Latitude)</label>
                        <input wire:model="latitude" type="text" placeholder="Contoh: -6.2088"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        @error('latitude')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-base font-semibold text-gray-900 mb-3">Garis Bujur
                            (Longitude)</label>
                        <input wire:model="longitude" type="text" placeholder="Contoh: 106.8456"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        @error('longitude')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Timezone & DST Card -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M20.884 10.554a9 9 0 1 0 -10.337 10.328" />
                            <path d="M3.6 9h16.8" />
                            <path d="M3.6 15h6.9" />
                            <path d="M11.5 3a17 17 0 0 0 -1.502 14.954" />
                            <path d="M12.5 3a17 17 0 0 1 2.52 7.603" />
                            <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M18 16.5v1.5l.5 .5" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Zona Waktu & DST</h3>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label for="timezone" class="block text-base font-semibold text-gray-900 mb-3">Zona
                            Waktu</label>
                        <select wire:model="timezone"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                            <option value="">Pilih Zona Waktu</option>
                            @foreach($tz as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('timezone')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="dst" class="block text-base font-semibold text-gray-900 mb-3">Daylight Saving
                            Time</label>
                        <input wire:model="dst" type="text" placeholder="Contoh: +1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        @error('dst')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Calculation Method -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-8">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M4 3m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                        <path d="M8 7m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" />
                        <path d="M8 14l0 .01" />
                        <path d="M12 14l0 .01" />
                        <path d="M16 14l0 .01" />
                        <path d="M8 17l0 .01" />
                        <path d="M12 17l0 .01" />
                        <path d="M16 17l0 .01" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Metode Perhitungan Waktu Sholat</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="max-w-md">
                    <label for="prayer_calc_method" class="block text-base font-semibold text-gray-900 mb-3">Pilih
                        Metode Perhitungan</label>
                    <select wire:model="prayer_calc_method"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                        <option value="">Pilih Metode Perhitungan</option>
                        @foreach($calc_method as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('prayer_calc_method')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Format Settings -->
        <div class="mb-8">
            <div class="flex items-center mb-6">
                <div class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></div>
                <h2 class="text-lg font-semibold text-gray-800">Format Waktu & Tanggal</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Time Format -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-900">Format Waktu Sholat</h3>
                    </div>
                    <div class="p-6">
                        <label for="time_format" class="block text-base font-semibold text-gray-900 mb-3">Tampilkan
                            dalam Format</label>
                        <select wire:model="time_format"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                            <option value="12h">12 Jam (AM/PM)</option>
                            <option value="24h">24 Jam</option>
                        </select>
                    </div>
                </div>

                <!-- Hijri Correction -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-900">Koreksi Tanggal Hijriah</h3>
                    </div>
                    <div class="p-6">
                        <label for="hijri_correction" class="block text-base font-semibold text-gray-900 mb-3">Koreksi
                            Tanggal</label>
                        <select wire:model="hijri_correction"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                            <option value="">Pilih Koreksi</option>
                            @for($i = -3; $i <= 3; $i++) <option value="{{ $i }}">{{ $i > 0 ? '+'.$i : $i }} hari
                                </option>
                                @endfor
                        </select>
                        @error('hijri_correction')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Prayer Names & Time Corrections -->
        <div class="mb-8">
            <div class="flex items-center mb-6">
                <div class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></div>
                <h2 class="text-lg font-semibold text-gray-800">Koreksi Nama & Waktu Sholat</h2>
            </div>

            <!-- Prayer Names -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                            <path d="M9 7l6 0" />
                            <path d="M9 11l6 0" />
                            <path d="M9 15l4 0" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Nama Waktu Sholat</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        @foreach(range(1, 6) as $index)
                        <div>
                            <label for="prayer{{ $index }}_alias"
                                class="block text-sm font-semibold text-gray-900 mb-2">
                                Sholat {{ $index }}
                            </label>
                            <input wire:model="prayer{{ $index }}_alias" type="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm">
                            @error("prayer{$index}_alias")
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Time Corrections -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor">
                                <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                <path d="M18 14v4h4" />
                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M15 3v4" />
                                <path d="M7 3v4" />
                                <path d="M3 11h16" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">Koreksi Waktu Sholat</h3>
                        </div>
                        <span class="text-sm text-gray-500 italic">± menit dari jadwal</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        @foreach(range(1, 6) as $index)
                        <div>
                            <label for="prayer{{ $index }}_correction"
                                class="block text-sm font-semibold text-gray-900 mb-2">
                                {{ Str::Title(${"prayer{$index}_alias"}) }}
                            </label>
                            <select wire:model="prayer{{ $index }}_correction"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors text-sm">
                                <option value="0">0 menit</option>
                                @for($i = -10; $i <= 10; $i++) @if($i !=0) <option value="{{ $i }}">{{ $i > 0 ? '+'.$i :
                                    $i }} menit</option>
                                    @endif
                                    @endfor
                            </select>
                            @error("prayer{$index}_correction")
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Countdown Settings -->
        <div class="mb-8">
            <div class="flex items-center mb-6">
                <div class="w-1.5 h-6 bg-blue-600 rounded-full mr-3"></div>
                <h2 class="text-lg font-semibold text-gray-800">Hitung Mundur & Durasi</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Adhan Duration -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-900">Durasi Adzan</h3>
                    </div>
                    <div class="p-6">
                        <label for="adhan_duration" class="block text-base font-semibold text-gray-900 mb-3">Jarak
                            Antara Adzan ke Iqomah</label>
                        <select wire:model="adhan_duration"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                            <option value="">Pilih Durasi</option>
                            @for($i = 1; $i <= 20; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('adhan_duration')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Iqomah Duration -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-900">Durasi Iqomah</h3>
                        <p class="text-sm text-gray-600 mt-1">Jarak antara iqomah ke sholat berjamaah</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach([1, 3, 4, 5, 6] as $index)
                            <div>
                                <label for="prayer{{ $index }}_iqomah_duration"
                                    class="block text-sm font-semibold text-gray-900 mb-2">
                                    {{ Str::Title(${"prayer{$index}_alias"}) }}
                                </label>
                                <select wire:model="prayer{{ $index }}_iqomah_duration"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors text-sm">
                                    <option value="0">0 menit</option>
                                    @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                        @endfor
                                </select>
                                @error("prayer{$index}_iqomah_duration")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Screen Lock -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 7v5l2 2" />
                            <path d="M17 22l5 -3l-5 -3z" />
                            <path d="M13.017 20.943a9 9 0 1 1 7.831 -7.292" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Kunci Layar Saat Sholat</h3>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Layar akan dikunci selama sholat berjamaah</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="sunrise_lock_duration" class="block text-base font-semibold text-gray-900 mb-3">
                                {{ Str::Title($prayer2_alias) }}
                            </label>
                            <select wire:model="sunrise_lock_duration"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                                <option value="">Pilih Durasi</option>
                                @for($i = 1; $i <= 6; $i++) <option value="{{ $i*5 }}">{{ $i*5 }} menit</option>
                                    @endfor
                            </select>
                            @error('sunrise_lock_duration')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="prayer_lock_duration"
                                class="block text-base font-semibold text-gray-900 mb-3">Sholat Berjamaah</label>
                            <select wire:model="prayer_lock_duration"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                                <option value="">Pilih Durasi</option>
                                @for($i = 1; $i <= 6; $i++) <option value="{{ $i*5 }}">{{ $i*5 }} menit</option>
                                    @endfor
                            </select>
                            @error('prayer_lock_duration')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="jumuah_lock_duration"
                                class="block text-base font-semibold text-gray-900 mb-3">Khutbah Jumat</label>
                            <select wire:model="jumuah_lock_duration"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                                <option value="">Pilih Durasi</option>
                                @for($i = 1; $i <= 12; $i++) <option value="{{ $i*5 }}">{{ $i*5 }} menit</option>
                                    @endfor
                            </select>
                            @error('jumuah_lock_duration')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 pt-6">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <div class="flex items-center text-sm text-gray-500">
                    <x-modified-date :updated_at="$updated_at" />
                </div>
                <div class="flex space-x-3">
                    <button type="submit" wire:loading.attr="disabled"
                        wire:loading.class="opacity-75 cursor-not-allowed"
                        class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span wire:loading.remove>Simpan Konfigurasi</span>
                        <span wire:loading>Menyimpan...</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-layouts.content>