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

    <form wire:submit="update">
        <div class="flex items-center">
            <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
            <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Konfigurasi Waktu Sholat
            </h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                    <div class="flex items-center">
                        <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0" />
                            <path d="M12 2l0 2" />
                            <path d="M12 20l0 2" />
                            <path d="M20 12l2 0" />
                            <path d="M2 12l2 0" />
                        </svg>
                        <h3 class="text-base font-bold">
                            Titik kordinat
                        </h3>
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="latitude" class="block text-base font-medium mb-2">Garis lintang</label>
                        <input wire:model="latitude" type="text"
                            class="text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('latitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-base font-medium mb-2">Garis bujur</label>
                        <input wire:model="longitude" type="text"
                            class="text-base  mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('longitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                    <div class="flex items-center">
                        <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.884 10.554a9 9 0 1 0 -10.337 10.328" />
                            <path d="M3.6 9h16.8" />
                            <path d="M3.6 15h6.9" />
                            <path d="M11.5 3a17 17 0 0 0 -1.502 14.954" />
                            <path d="M12.5 3a17 17 0 0 1 2.52 7.603" />
                            <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M18 16.5v1.5l.5 .5" />
                        </svg>
                        <h3 class="text-base font-bold">
                            Timezone & DST
                        </h3>
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="timezone" class="block text-base font-medium mb-2">Time zone</label>
                        <select wire:model="timezone"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Pilih Timezone</option>
                            @foreach($tz as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('timezone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="dst" class="block text-base font-medium mb-2">Daylight Saving Time</label>
                        <input wire:model="dst" type="text"
                            class="text-base  mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('dst') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                    <div class="flex items-center">
                        <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 3m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                            <path d="M8 7m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" />
                            <path d="M8 14l0 .01" />
                            <path d="M12 14l0 .01" />
                            <path d="M16 14l0 .01" />
                            <path d="M8 17l0 .01" />
                            <path d="M12 17l0 .01" />
                            <path d="M16 17l0 .01" />
                        </svg>
                        <h3 class="text-base font-bold">
                            Metode perhitungan waktu sholat
                        </h3>
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="prayer_calc_method" class="block text-base font-medium mb-2">Metode
                            perhitungan</label>
                        <select wire:model="prayer_calc_method"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Pilih Metode Perhitungan</option>
                            @foreach($calc_method as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('prayer_calc_method') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
            <h1 class="text-base lg:text-xl font-semibold text-gray-800 mb-6 mt-6">Format Jam dan Tanggal</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                    <div class="flex items-center">
                        <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                            <path d="M18 14v4h4" />
                            <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M15 3v4" />
                            <path d="M7 3v4" />
                            <path d="M3 11h16" />
                        </svg>
                        <h3 class="text-base font-bold">
                            Format waktu sholat
                        </h3>
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="time_format" class="block text-base font-medium mb-2">Tampilkan dalam format</label>
                        <select wire:model="time_format"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="12h">12 jam</option>
                            <option value="24h">24 jam</option>
                        </select>
                        @error('time_format') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                    <div class="flex items-center">
                        <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                            <path d="M18 14v4h4" />
                            <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M15 3v4" />
                            <path d="M7 3v4" />
                            <path d="M3 11h16" />
                        </svg>
                        <h3 class="text-base font-bold">
                            Koreksi tanggal hijriah
                        </h3>
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="hijri_correction" class="block text-base font-medium mb-2">Koreksi tanggal</label>
                        <select wire:model="hijri_correction"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value="">Silahkan pilih</option>
                            @for($i = -3; $i <= 3; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                        @error('hijri_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
            <h1 class="text-base lg:text-xl font-semibold text-gray-800 mb-6 mt-6">Koreksi Nama & Waktu Sholat</h1>
        </div>

        <div class="border border-gray-200 rounded-2xl">
            <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                <div class="flex items-center">
                    <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                        <path d="M9 7l6 0" />
                        <path d="M9 11l6 0" />
                        <path d="M9 15l4 0" />
                    </svg>
                    <h3 class="text-base font-bold">
                        Ganti nama sholat
                    </h3>
                </div>
            </div>
            <div class="border-t border-gray-200 p-5">
                <div class="grid grid-cols-2 gap-x-2 sm:grid-cols-6 space-y-6">
                    <div>
                        <label for="prayer1" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer1_alias) }}</label>
                        <input wire:model="prayer1_alias" type="text"
                            class="text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer1_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer2" class="block text-base font-medium mb-2">{{ Str::Title($prayer2_alias)
                            }}</label>
                        <input wire:model="prayer2_alias" type="text"
                            class="text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer2_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer3" class="block text-base font-medium mb-2">{{ Str::Title($prayer3_alias)
                            }}</label>
                        <input wire:model="prayer3_alias" type="text"
                            class="text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer3_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer4" class="block text-base font-medium mb-2">{{ Str::Title($prayer4_alias)
                            }}</label>
                        <input wire:model="prayer4_alias" type="text"
                            class="text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer4_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer5" class="block text-base font-medium mb-2">{{ Str::Title($prayer5_alias)
                            }}</label>
                        <input wire:model="prayer5_alias" type="text"
                            class="text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer5_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer6" class="block text-base font-medium mb-2">{{ Str::Title($prayer6_alias)
                            }}</label>
                        <input wire:model="prayer6_alias" type="text"
                            class="text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer6_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="border border-gray-200 rounded-2xl mt-6">
            <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                <div class="flex items-center">
                    <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                        <path d="M18 14v4h4" />
                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M15 3v4" />
                        <path d="M7 3v4" />
                        <path d="M3 11h16" />
                    </svg>
                    <h3 class="text-base font-bold">
                        Koreksi waktu sholat
                    </h3>
                </div>
                <p class="text-base font-medium text-gray-600 italic">Koreksi waktu sholat jika lebih cepat atau
                    lambat sekian menit dari jadwal.</p>
            </div>
            <div class="border-t border-gray-200 p-5">
                <div class="grid grid-cols-2 gap-x-2 sm:grid-cols-6 space-y-6">
                    <div>
                        <label for="prayer1_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer1_alias) }}</label>
                        <select wire:model="prayer1_correction"
                            class="text-base py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i > 0 ? '+'.$i : $i }} menit
                                </option>
                                @endfor
                        </select>
                        @error('prayer1_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer2_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer2_alias) }}</label>
                        <select wire:model="prayer2_correction"
                            class="text-base py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i > 0 ? '+'.$i : $i }} menit
                                </option>
                                @endfor
                        </select>
                        @error('prayer2_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer3_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer3_alias) }}</label>
                        <select wire:model="prayer3_correction"
                            class="text-base py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i > 0 ? '+'.$i : $i }} menit
                                </option>
                                @endfor
                        </select>
                        @error('prayer3_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer4_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer4_alias) }}</label>
                        <select wire:model="prayer4_correction"
                            class="text-base py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i > 0 ? '+'.$i : $i }} menit
                                </option>
                                @endfor
                        </select>
                        @error('prayer4_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer5_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer5_alias) }}</label>
                        <select wire:model="prayer5_correction"
                            class="text-base py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i > 0 ? '+'.$i : $i }} menit
                                </option>
                                @endfor
                        </select>
                        @error('prayer5_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer6_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer6_alias) }}</label>
                        <select wire:model="prayer6_correction"
                            class="text-base py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i > 0 ? '+'.$i : $i }} menit
                                </option>
                                @endfor
                        </select>
                        @error('prayer6_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
            <h1 class="text-base lg:text-xl font-semibold text-gray-800 mb-6 mt-6">Hitung Mundur Waktu Sholat</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                    <div class="flex items-center">
                        <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 7v5l2 2" />
                            <path d="M17 22l5 -3l-5 -3z" />
                            <path d="M13.017 20.943a9 9 0 1 1 7.831 -7.292" />
                        </svg>
                        <h3 class="text-base font-bold">
                            Durasi adzan
                        </h3>
                    </div>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="adhan_duration" class="block text-base font-medium mb-2">Jarak antara adzan ke
                            iqomah</label>
                        <select wire:model="adhan_duration"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = 1; $i <= 20; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('adhan_duration') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="border border-gray-200 rounded-2xl mt-6">
            <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                <div class="flex items-center">
                    <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 7v5l2 2" />
                        <path d="M17 22l5 -3l-5 -3z" />
                        <path d="M13.017 20.943a9 9 0 1 1 7.831 -7.292" />
                    </svg>
                    <h3 class="text-base font-bold">
                        Durasi iqomah
                    </h3>
                </div>
                <p class="text-base font-medium text-gray-600 italic">Jarak antara iqomah ke sholat berjamaah.</p>
            </div>
            <div class="border-t border-gray-200 p-5">
                <div class="grid grid-cols-2 gap-x-2 sm:grid-cols-6 space-y-6">
                    <div>
                        <label for="prayer1_iqomah_duration" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer1_alias) }}</label>
                        <select wire:model="prayer1_iqomah_duration"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = 0; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer1_iqomah_duration') <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="prayer3_iqomah_duration" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer3_alias) }}</label>
                        <select wire:model="prayer3_iqomah_duration"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = 0; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer3_iqomah_duration') <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="prayer4_iqomah_duration" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer4_alias) }}</label>
                        <select wire:model="prayer4_iqomah_duration"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = 0; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer4_iqomah_duration') <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="prayer5_iqomah_duration" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer5_alias) }}</label>
                        <select wire:model="prayer5_iqomah_duration"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = 0; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer5_iqomah_duration') <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="prayer6_iqomah_duration" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer6_alias) }}</label>
                        <select wire:model="prayer6_iqomah_duration"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = 0; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer6_iqomah_duration') <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
            <h1 class="text-base lg:text-xl font-semibold text-gray-800 mb-6 mt-6">Kunci Layar di Waktu Sholat</h1>
        </div>

        <div class="border border-gray-200 rounded-t-2xl">
            <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                <div class="flex items-center">
                    <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 7v5l2 2" />
                        <path d="M17 22l5 -3l-5 -3z" />
                        <path d="M13.017 20.943a9 9 0 1 1 7.831 -7.292" />
                    </svg>
                    <h3 class="text-base font-bold">
                        Atur durasi
                    </h3>
                </div>
                <p class="text-base font-medium text-gray-600 italic">Layar akan dikunci selama sholat berlangsung.</p>
            </div>
            <div class="border-t border-gray-200 p-5">
                <div class="grid grid-cols-1 gap-x-2 sm:grid-cols-3 space-y-6">
                    <div>
                        <label for="sunrise_lock_duration" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer2_alias) }}</label>
                        <select wire:model="sunrise_lock_duration"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = 1; $i <= 6; $i++) <option value="{{ $i*5 }}">{{ $i*5 }} menit</option>
                                @endfor
                        </select>
                        @error('sunrise_lock_duration') <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="prayer_lock_duration" class="block text-base font-medium mb-2">Sholat
                            berjamaah</label>
                        <select wire:model="prayer_lock_duration"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = 1; $i <= 6; $i++) <option value="{{ $i*5 }}">{{ $i*5 }} menit</option>
                                @endfor
                        </select>
                        @error('prayer_lock_duration') <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="jumuah_lock_duration" class="block text-base font-medium mb-2">Khutbah
                            Jumat</label>
                        <select wire:model="jumuah_lock_duration"
                            class="text-base  py-3 bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = 1; $i <= 12; $i++) <option value="{{ $i*5 }}">{{ $i*5 }} menit</option>
                                @endfor
                        </select>
                        @error('jumuah_lock_duration') <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="px-2 py-2 mt-3 border border-gray-200 bg-stone-100">
            <div class="flex justify-between">
                <div class="flex items-center">
                    <svg class="h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
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
                    <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    <span wire:loading.remove>Simpan</span>
                    <span wire:loading>Proses Simpan...</span>
                </button>
            </div>
        </div>
    </form>

</x-layouts.content>