<x-layouts.content>

    @if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
        class="p-3 mt-2 mb-4 font-medium text-green-800 bg-green-100">
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
                <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                    <h3 class="text-base font-bold">
                        Titik kordinat
                    </h3>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="latitude" class="block text-base font-medium mb-2">Garis lintang</label>
                        <input wire:model="latitude" type="text"
                            class="text-base lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('latitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-base font-medium mb-2">Garis bujur</label>
                        <input wire:model="longitude" type="text"
                            class="text-base lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('longitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                    <h3 class="text-base font-bold">
                        Timezone & DST
                    </h3>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="timezone" class="block text-base font-medium mb-2">Time zone</label>
                        <select wire:model="timezone"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
                            class="text-base lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('dst') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                    <h3 class="text-base font-bold">
                        Metode perhitungan waktu sholat
                    </h3>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="prayer_calc_method" class="block text-base font-medium mb-2">Metode
                            perhitungan</label>
                        <select wire:model="prayer_calc_method"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                    <h3 class="text-base font-bold">
                        Format waktu sholat
                    </h3>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="time_format" class="block text-base font-medium mb-2">Tampilkan dalam format</label>
                        <select wire:model="time_format"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="12h">12 jam</option>
                            <option value="24h">24 jam</option>
                        </select>
                        @error('time_format') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 rounded-2xl">
                <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                    <h3 class="text-base font-bold">
                        Koreksi tanggal Hijriah
                    </h3>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="hijri_correction" class="block text-base font-medium mb-2">Koreksi tanggal</label>
                        <select wire:model="hijri_correction"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
            <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                <h3 class="text-base font-bold">
                    Ganti nama sholat
                </h3>
            </div>
            <div class="border-t border-gray-200 p-5">
                <div class="grid grid-cols-2 gap-x-2 sm:grid-cols-6 space-y-6">
                    <div>
                        <label for="prayer1" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer1_alias) }}</label>
                        <input wire:model="prayer1_alias" type="text"
                            class="text-base lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer1_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer2" class="block text-base font-medium mb-2">{{ Str::Title($prayer2_alias)
                            }}</label>
                        <input wire:model="prayer2_alias" type="text"
                            class="text-base lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer2_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer3" class="block text-base font-medium mb-2">{{ Str::Title($prayer3_alias)
                            }}</label>
                        <input wire:model="prayer3_alias" type="text"
                            class="text-base lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer3_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer4" class="block text-base font-medium mb-2">{{ Str::Title($prayer4_alias)
                            }}</label>
                        <input wire:model="prayer4_alias" type="text"
                            class="text-base lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer4_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer5" class="block text-base font-medium mb-2">{{ Str::Title($prayer5_alias)
                            }}</label>
                        <input wire:model="prayer5_alias" type="text"
                            class="text-base lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer5_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer6" class="block text-base font-medium mb-2">{{ Str::Title($prayer6_alias)
                            }}</label>
                        <input wire:model="prayer6_alias" type="text"
                            class="text-base lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                        @error('prayer6_alias') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="border border-gray-200 rounded-2xl mt-6">
            <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                <h3 class="text-base font-bold">
                    Koreksi waktu sholat
                </h3>
                <p class="text-base font-medium text-gray-600 italic">Koreksi waktu sholat jika lebih cepat atau lambat
                    sekian
                    menit dari jadwal.</p>
            </div>
            <div class="border-t border-gray-200 p-5">
                <div class="grid grid-cols-2 gap-x-2 sm:grid-cols-6 space-y-6">
                    <div>
                        <label for="prayer1_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer1_alias) }}</label>
                        <select wire:model="prayer1_correction"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer1_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer2_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer2_alias) }}</label>
                        <select wire:model="prayer2_correction"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer2_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer3_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer3_alias) }}</label>
                        <select wire:model="prayer3_correction"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer3_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer4_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer4_alias) }}</label>
                        <select wire:model="prayer4_correction"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer4_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer5_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer5_alias) }}</label>
                        <select wire:model="prayer5_correction"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
                                @endfor
                        </select>
                        @error('prayer5_correction') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="prayer6_correction" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer6_alias) }}</label>
                        <select wire:model="prayer6_correction"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
                            <option value=""></option>
                            @for($i = -10; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }} menit</option>
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
                <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                    <h3 class="text-base font-bold">
                        Adzan
                    </h3>
                    <p class="text-base font-medium text-gray-600 italic">Durasi adzan</p>
                </div>
                <div class="border-t border-gray-200 p-5 space-y-6">
                    <div>
                        <label for="adhan_duration" class="block text-base font-medium mb-2">Jarak antara adzan ke
                            iqomah</label>
                        <select wire:model="adhan_duration"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
            <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                <h3 class="text-base font-bold">
                    Iqomah
                </h3>
                <p class="text-base font-medium text-gray-600 italic">Jarak antara iqomah ke sholat berjamaah</p>
            </div>
            <div class="border-t border-gray-200 p-5">
                <div class="grid grid-cols-2 gap-x-2 sm:grid-cols-6 space-y-6">
                    <div>
                        <label for="prayer1_iqomah_duration" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer1_alias) }}</label>
                        <select wire:model="prayer1_iqomah_duration"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
            <div class="px-4 py-5 bg-gray-50 rounded-t-2xl">
                <h3 class="text-base font-bold">
                    Atur durasi
                </h3>
                <p class="text-base font-medium text-gray-600 italic">Layar akan dikunci selama waktu sholat.</p>
            </div>
            <div class="border-t border-gray-200 p-5">
                <div class="grid grid-cols-1 gap-x-2 sm:grid-cols-3 space-y-6">
                    <div>
                        <label for="sunrise_lock_duration" class="block text-base font-medium mb-2">{{
                            Str::Title($prayer2_alias) }}</label>
                        <select wire:model="sunrise_lock_duration"
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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
                            class="text-base lg:text-base py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">>
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

        <div class="px-2 py-2 mt-3 border border-gray-200 bg-gray-50">
            <div class="flex justify-end">
                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-75"
                    class="flex text-center items-center border border-transparent bg-blue-500 hover:bg-blue-600 py-2 px-4 text-base text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                    <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    <span wire:loading.remove>Simpan</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </div>
    </form>

</x-layouts.content>