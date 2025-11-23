<x-layouts.content>
    <x-session-message />

    <form wire:submit.prevent="update">
        <!-- Header -->
        <div class="flex items-center mb-6 mt-6">
            <img src="{{ '/storage/images/icon/point.png' }}" class="h-5" alt="logo">
            <h1 class="text-xl font-semibold text-gray-800 ml-2">Atur Profil Masjid</h1>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Left Column - Mosque Information -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Mosque Information Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor">
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.645 0 1.218 .305 1.584 .78" />
                                <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4" />
                                <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Informasi Masjid
                            </h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Mosque Name -->
                        <div>
                            <label for="name" class="block text-base font-semibold text-gray-900 mb-3">Nama
                                Masjid</label>
                            <input wire:model="name" type="text" placeholder="Masukkan nama masjid..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-base font-semibold text-gray-900 mb-3">Alamat
                                Lengkap</label>
                            <textarea wire:model="address" placeholder="Masukkan alamat lengkap masjid..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition-colors"
                                rows="3"></textarea>
                            @error('address')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Information -->
                        <div>
                            <label for="description" class="block text-base font-semibold text-gray-900 mb-3">Informasi
                                Tambahan</label>
                            <textarea wire:model="description"
                                placeholder="Deskripsi atau informasi tambahan tentang masjid..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition-colors"
                                rows="3"></textarea>
                            @error('description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label for="contact_no" class="block text-base font-semibold text-gray-900 mb-3">Nomor
                                Telepon</label>
                            <input wire:model="contact_no" type="text" placeholder="Contoh: +62 812-3456-7890"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('contact_no')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Logo & Theme -->
            <div class="space-y-6">
                <!-- Logo Settings Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor">
                                <path d="M15 8h.01" />
                                <path d="M11 20h-4a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v4" />
                                <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l3 3" />
                                <path d="M14 14l1 -1c.31 -.298 .644 -.497 .987 -.596" />
                                <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Logo Masjid
                            </h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Logo Preview -->
                        <div class="text-center">
                            <label class="block text-base font-semibold text-gray-900 mb-4">Pratinjau Logo</label>
                            <div class="inline-block border-2 border-gray-200 rounded-xl p-2 bg-gray-50">
                                @if ($image_id && $image_name)
                                <img src="{{ asset('storage/' . $image_name) }}" alt="Logo Masjid"
                                    class="h-32 w-32 object-contain bg-gray-300 rounded-lg mx-auto shadow-sm">
                                @else
                                <div
                                    class="h-32 w-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300 mx-auto">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm text-gray-500">Belum ada logo</span>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Change Logo Button -->
                            <button type="button" wire:click="openImageModal"
                                class="w-full mt-4 flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                {{ $image_id ? 'Ganti Logo' : 'Pilih Logo' }}
                            </button>
                            @error('image_id')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Theme Settings Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor">
                                <path
                                    d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                                <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Tema Jam Sholat
                            </h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Theme Selection -->
                        <div>
                            <label for="selected_theme" class="block text-base font-semibold text-gray-900 mb-3">Pilih
                                Tema</label>
                            <select wire:model.live="selected_theme"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors">
                                <option value="">Pilih tema yang diinginkan</option>
                                @for($i = 1; $i <= 4; $i++) <option value="theme{{ $i }}">Tema {{ $i }}</option>
                                    @endfor
                            </select>
                            @error('selected_theme')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Theme Preview -->
                        <div>
                            <label class="block text-base font-semibold text-gray-900 mb-3">Pratinjau Tema</label>
                            @if($selected_theme)
                            <div class="border-2 border-blue-200 rounded-xl overflow-hidden shadow-md">
                                <img class="w-full h-auto object-cover"
                                    src="{{ '/storage/images/screenshot/'.$selected_theme.'.png' }}"
                                    alt="Pratinjau tema {{ $selected_theme }}"
                                    wire:key="theme-preview-{{ $selected_theme }}">
                            </div>
                            <p class="text-sm text-gray-600 text-center mt-2">Tema {{ substr($selected_theme, -1) }} -
                                Pratinjau</p>
                            @else
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 w-full h-48 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 20l-5.447 -2.724A1 1 0 0 1 3 16.382V5.618a1 1 0 0 1 1.447 -.894L9 7m0 13l6 -3m-6 3V7m6 10l4.553 2.276A1 1 0 0 0 21 18.382V7.618a1 1 0 0 0 -.553 -.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                    <p class="text-sm text-gray-500">Pilih tema untuk melihat pratinjau</p>
                                </div>
                            </div>
                            @endif
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
                        <span wire:loading.remove>Simpan Perubahan</span>
                        <span wire:loading>Menyimpan...</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Image Selection Modal -->
    @include('livewire.image.image-modal')
</x-layouts.content>