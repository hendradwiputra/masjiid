<x-layouts.content>
    <div class="flex items-center mb-6 mt-6">
        <img src="{{ asset('storage/images/icon/point.png') }}" class="h-5" alt="Point Icon">
        <h1 class="text-xl font-semibold text-gray-800">Unggah Media</h1>
    </div>

    <div class="grid grid-cols-1 max-w-2xl">
        <div class="space-y-6">
            <div class="border border-gray-200 rounded-2xl shadow-sm p-6 space-y-6">

                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    <div class="mb-6 space-y-3">
                        <label class="block text-base font-bold mb-2">Pilih file</label>
                        <input type="file" wire:model.live="file" accept="image/*,video/*"
                            class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <p class="text-sm text-gray-600 font-semibold">Maximum file size : 50 MB for videos.</p>
                        @error('file')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Improved Preview Section -->
                    @if ($file)
                    <label class="block text-base font-bold mb-2">Pratinjau</label>
                    <div class="bg-gray-300 mt-3 mb-3 rounded-lg overflow-hidden">
                        @if ($this->isVideoFile($file))
                        <video src="{{ $file->temporaryUrl() }}" controls class="w-full max-h-96 object-contain">
                            Browser Anda tidak mendukung pemutar video.
                        </video>
                        @else
                        <img src="{{ $file->temporaryUrl() }}" class="w-full max-h-96 object-contain">
                        @endif
                    </div>

                    <!-- File Info -->
                    <div class="mb-4 bg-gray-100 rounded-lg">
                        <div class="grid grid-cols-2 gap-2 text-md">
                            <div>
                                <span class="font-semibold">Tipe File:</span>
                                <span>{{ $this->isVideoFile($file) ? 'Video' : 'Gambar' }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Ukuran:</span>
                                <span>{{ $currentFileSize }}</span>
                            </div>
                            <div class="col-span-2">
                                <span class="font-semibold">Nama File:</span>
                                <span class="break-all">{{ $file->getClientOriginalName() }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="cancel"
                            class="flex items-center px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" wire:target="file"
                            class="flex items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-3 px-6 text-base text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                            <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                <path d="M9 15l3 -3l3 3" />
                                <path d="M12 12l0 9" />
                            </svg>
                            <span wire:loading.remove wire:target="file">Unggah</span>
                            <span wire:loading wire:target="file">Proses Unggah...</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</x-layouts.content>