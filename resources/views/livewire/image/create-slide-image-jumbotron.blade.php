<x-layouts.content>
    <div class="flex items-center mb-6 mt-6">
        <img src="{{ asset('storage/images/icon/point.png') }}" class="h-5" alt="Point Icon">
        <h1 class="text-xl font-semibold text-gray-800">Tambah Slide</h1>
    </div>

    <div class="mx-auto border border-gray-200 rounded-2xl shadow-2xl p-6">
        <form wire:submit="save">
            <div class="grid grid-cols-1 gap-6">
                <!-- Image Selection -->
                <div class="space-y-4">
                    <div class="grid grid-cols-1 lg:grid-cols-3 items-center">
                        <label class="block text-base font-semibold text-gray-700 mb-2">Gambar</label>
                        <div class="flex items-center space-x-4 w-lg">
                            @if($image_id && $selectedImage)
                            <div class="border border-gray-300 rounded-lg p-2">
                                <img src="{{ asset('storage/' . $selectedImage->image_name) }}" alt="Selected Image"
                                    class="h-50 w-60 bg-stone-400 object-cover rounded">
                            </div>
                            @endif
                            <div class="mt-2">
                                <button type="button" wire:click="openImageModal"
                                    class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Pilih Gambar
                                </button>
                            </div>
                        </div>
                        @error('image_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 items-center">
                        <label class="block text-base font-semibold text-gray-700 mb-2">Judul (Optional)</label>
                        <input type="text" wire:model="title"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-lg rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                        @error('title')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 items-center">
                        <label class="block text-base font-semibold text-gray-700 mb-2">Isi (Optional)</label>
                        <textarea wire:model="content"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-lg rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none"
                            rows="3"></textarea>
                        @error('content')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 items-center">
                        <label class="block text-base font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" wire:model="start_date"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                        @error('start_date')
                        <span class="text-red-500 text-sm ml-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 items-center">
                        <label class="block text-base font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" wire:model="end_date"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                        @error('end_date')
                        <span class="text-red-500 text-sm ml-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 items-center">
                        <label class="block text-base font-semibold text-gray-700 mb-2">Status Slide</label>
                        <select wire:model="status_id" class="w-full border border-gray-300 rounded-lg px-2 py-3">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                        @error('status_id')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-2">
                    <div class="flex justify-end space-x-3">
                        <button type="button" wire:click="cancel"
                            class="flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                            <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M9 12h12l-3 -3" />
                                <path d="M18 15l3 -3" />
                            </svg>
                            Batal
                        </button>
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
        </form>
    </div>

    <!-- Image Selection Modal -->
    @include('livewire.image.image-modal')
</x-layouts.content>