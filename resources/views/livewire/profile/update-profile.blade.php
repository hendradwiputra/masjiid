<x-layouts.content>
    <div>
        @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="flex items-center p-3 mt-2 mb-4 font-medium text-green-800 bg-green-100">
            <svg class="h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 11l3 3l8 -8" />
                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
            </svg>
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit.prevent="update">
            <div class="flex items-center">
                <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
                <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Atur Profil Masjid</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div class="border border-gray-200 rounded-2xl shadow-2xl">
                        <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                            <div class="flex items-center">
                                <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.645 0 1.218 .305 1.584 .78" />
                                    <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4" />
                                    <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                </svg>
                                <h3 class="text-base font-bold">
                                    Informasi Masjid
                                </h3>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 p-5 space-y-6">
                            <div>
                                <label for="name" class="block text-base font-semibold mb-2">Nama Masjid</label>
                                <input wire:model="name" type="text"
                                    class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                                @error('name') <span class="text-red-500 text-base">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="address" class="block text-base font-semibold mb-2">Alamat</label>
                                <textarea wire:model="address"
                                    class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none"
                                    rows="3"></textarea>
                            </div>
                            <div>
                                <label for="description" class="block text-base font-semibold mb-2">Informasi
                                    tambahan</label>
                                <textarea wire:model="description"
                                    class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none"
                                    rows="3"></textarea>
                            </div>
                            <div>
                                <label for="contact_no" class="block text-base font-semibold mb-2">Nomor telepon</label>
                                <input wire:model="contact_no" type="text"
                                    class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="border border-gray-200 rounded-2xl shadow-2xl">
                        <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                            <div class="flex items-center">
                                <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 8h.01" />
                                    <path d="M11 20h-4a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v4" />
                                    <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l3 3" />
                                    <path d="M14 14l1 -1c.31 -.298 .644 -.497 .987 -.596" />
                                    <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                </svg>
                                <h3 class="text-base font-bold">
                                    Pengaturan Logo
                                </h3>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 p-5 ">
                            <div>
                                <label class="block text-base font-semibold mb-2">Pratinjau</label>
                                <div class="flex items-center space-x-4">
                                    @if ($image_id && $image_name)
                                    <img src="{{ asset('storage/' . $image_name) }}" alt="Profile Logo"
                                        class="h-30 w-30 object-cover rounded border border-gray-300 bg-stone-600">
                                    @else
                                    <div
                                        class="h-24 w-24 bg-stone-600 rounded flex items-center justify-center border border-gray-300">
                                        <span class="text-gray-300">No Logo</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="mt-2">
                                    <button type="button" wire:click="openImageModal"
                                        class="flex item-center px-2 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M15 8h.01" />
                                            <path d="M11 20h-4a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v4" />
                                            <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l3 3" />
                                            <path d="M14 14l1 -1c.31 -.298 .644 -.497 .987 -.596" />
                                            <path
                                                d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                        </svg>
                                        Ubah Logo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-2xl shadow-2xl">
                        <div class="px-4 py-5 bg-stone-100 rounded-t-2xl">
                            <div class="flex items-center">
                                <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                                    <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                    <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                    <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                </svg>
                                <h3 class="text-base font-bold">
                                    Ganti Theme
                                </h3>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 p-5 space-y-6">
                            <div>
                                <label for="selected_theme" class="block text-base font-semibold mb-2">Pilih
                                    tema</label>
                                <select wire:model="selected_theme"
                                    class="text-base lg:text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Pilih tema</option>
                                    @for($i = 1; $i <= 4; $i++) <option value="theme{{ $i }}">Theme{{ $i }}</option>
                                        @endfor
                                </select>
                                @error('selected_theme') <span class="text-red-500 text-base">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="px-2 py-2 mt-3 border border-gray-200 bg-stone-100 shadow-2xl">
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
    </div>

    <!-- Image Selection Modal -->
    <div x-data="{ showImageModal: @entangle('showImageModal') }" x-show="showImageModal" x-cloak
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-4xl">
            <div class="overflow-y-auto max-h-[80vh]">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Pilih Logo</h2>
                    <button @click="showImageModal = false" wire:click="closeImageModal"
                        class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6L6 18" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @if ($images->count())
                <div class="grid grid-cols-4 md:grid-cols-6 gap-4">
                    @foreach ($images as $image)
                    <div class="border border-gray-200 rounded p-1 shadow cursor-pointer"
                        wire:click="selectImage({{ $image->id }})">
                        <img src="{{ asset('storage/' . $image->image_name) }}" alt="{{ $image->id }} image"
                            class="bg-stone-700 max-w-full h-25 object-cover rounded hover:bg-stone-400">
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-600">No logos available. Please upload a logo in the image gallery.</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.content>