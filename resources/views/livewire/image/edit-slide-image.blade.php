<x-layouts.content>
    <div class="flex items-center mb-6 mt-6">
        <img src="{{ asset('storage/images/icon/point.png') }}" class="h-5" alt="Point Icon">
        <h1 class="text-xl font-semibold text-gray-800">Edit Slide</h1>
    </div>

    <form wire:submit="update">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="space-y-8">
                <div class="border border-gray-200 rounded-lg shadow-2xl">
                    <div class="px-4 py-5 space-y-6">
                        <div>
                            <div class="flex items-center space-x-4">
                                @if($image_id && $selectedImage)
                                <div class="border border-gray-300 rounded-lg p-2">
                                    <img src="{{ asset('storage/' . $selectedImage->image_name) }}" alt="Selected Image"
                                        class="h-60 w-90 bg-stone-400 object-cover rounded">
                                </div>
                                @endif
                            </div>
                            <div class="mt-3">
                                <button type="button" wire:click="openImageModal"
                                    class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Pilih Gambar
                                </button>
                            </div>
                            @error('image_id')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-base font-semibold text-gray-700 mb-2">Mode Full Screen</label>
                            <select wire:model="fullscreen_mode"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                            @error('status_id')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg shadow-2xl">
                    <div class="px-4 py-5 space-y-6">
                        <label class="block text-base font-semibold text-gray-700 mb-2">Status Slide</label>
                        <select wire:model="status_id" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                        @error('status_id')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="border border-gray-200 rounded-lg shadow-2xl">
                    <div class="px-4 py-5 space-y-6">
                        <div>
                            <label class="block text-base font-semibold text-gray-700 mb-2">Judul</label>
                            <input type="text" wire:model="title"
                                class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                            @error('title')
                            <span class="text-red-500 text-base">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-base font-semibold text-gray-700 mb-2">Isi Konten</label>
                            <textarea wire:model="content"
                                class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none"
                                rows="6"></textarea>
                            @error('content')
                            <span class="text-red-500 text-base">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-base font-semibold text-gray-700 mb-2">Penulis</label>
                            <input type="text" wire:model="author"
                                class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                            @error('author')
                            <span class="text-red-500 text-base">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg shadow-2xl">
                    <div class="px-4 py-5 space-y-6">
                        <div>
                            <label class="block text-base font-semibold text-gray-700 mb-2">Tanggal
                                Publikasi</label>
                            <input type="date" wire:model="start_date"
                                class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                            @error('start_date')
                            <span class="text-red-500 text-sm ml-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-base font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                            <input type="date" wire:model="end_date"
                                class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                            @error('end_date')
                            <span class="text-red-500 text-sm ml-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="px-2 py-2 mt-3 border border-gray-200 shadow-2xl">
            <!-- Action Buttons -->
            <div class="flex md:justify-between space-x-3">
                @include('livewire.modified-date')

                <div class="flex space-x-2">
                    <button type="button" wire:click="cancel"
                        class="flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M9 12h12l-3 -3" />
                            <path d="M18 15l3 -3" />
                        </svg>
                        Batal
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-75"
                        class="flex text-center items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4 text-base text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                        <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                        <span wire:loading.remove>Update</span>
                        <span wire:loading>Proses Update...</span>
                    </button>
                </div>
            </div>

        </div>
    </form>


    <!-- Image Selection Modal -->
    <div x-data="{ showImageModal: @entangle('showImageModal') }" x-show="showImageModal" x-cloak
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-4xl">
            <div class="overflow-y-auto max-h-[80vh]">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Pilih Gambar</h2>
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
                    <div class="border border-gray-200 rounded p-1 shadow cursor-pointer hover:border-blue-500 hover:shadow-lg transition-all"
                        wire:click="selectImage({{ $image->id }})">
                        <img src="{{ asset('storage/' . $image->image_name) }}" alt="{{ $image->id }} image"
                            class="bg-stone-700 max-w-full h-25 object-cover rounded hover:opacity-80">
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-600">Tidak ada gambar tersedia. Silakan upload gambar di galeri.</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.content>