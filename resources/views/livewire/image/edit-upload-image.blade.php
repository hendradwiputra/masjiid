<x-layouts.content>
    <div class="flex items-center mb-6 mt-6">
        <img src="{{ asset('storage/images/icon/point.png') }}" class="h-5" alt="Point Icon">
        <h1 class="text-xl font-semibold text-gray-800">Unggah Media</h1>
    </div>

    <div class="grid grid-cols-1 max-w-2xl">
        <div class="space-y-6">
            <div class="border border-gray-200 rounded-2xl shadow-sm p-6 space-y-6">

                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    <!-- Current File Preview -->
                    <label class="block text-base font-bold mb-2">File saat ini</label>
                    @if ($selectedFileName)
                    <div class="relative bg-black rounded-lg overflow-hidden">
                        <div class="aspect-video bg-gray-900">
                            @if ($selectedFileType !== 'video')
                            <img src="{{ asset('storage/' . $selectedFileName) }}" class="w-full h-full object-contain"
                                alt="Current image">
                            @else

                            <div class="relative bg-black rounded-lg overflow-hidden">
                                <div class="aspect-video bg-gray-900">

                                    <video class="w-full h-full object-cover" controls preload="metadata"
                                        poster="{{ asset('storage/' . $selectedFileName) }}">
                                        <source src="{{ asset('storage/' . $selectedFileName) . '#t=0.1' }}"
                                            type="{{ $selectedImageMimeType }}">
                                        Browser Anda tidak mendukung video.
                                    </video>

                                    <!-- Play icon -->
                                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                        <div class="bg-black/60 rounded-full p-6">
                                            <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7L8 5z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Current File Info -->
                    <div class="mt-2 p-0 bg-gray-50 rounded-lg">
                        <div class="flex gap-2 text-base justify-between">
                            <div>
                                <span class="font-bold">Tipe File:</span>
                                <span>{{ $selectedFileType === 'video' ? 'Video' : 'Gambar' }}</span>
                            </div>
                            <div>
                                <span class="font-bold">Ukuran:</span>
                                <span>{{ $selectedImageSize }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- New File Selection -->
                    <div class="mt-8 mb-4">
                        <label class="block text-base font-semibold mb-2">Pilih file baru</label>
                        <input type="file" wire:model.live="file" accept="image/*,video/*"
                            class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('file')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror

                        <!-- Display new file size -->
                        @if ($currentFileSize)
                        <div class="mt-2">
                            <span class="text-sm text-gray-600">Ukuran File Baru: {{ $currentFileSize }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- New File Preview - Same as add modal -->
                    @if ($file)
                    <label class="block text-base font-semibold mb-2">Pratinjau File Baru</label>
                    <div class="bg-stone-400 mt-3 mb-3 rounded overflow-hidden">
                        @if ($this->isVideoFile($file))
                        <video src="{{ $file->temporaryUrl() }}" controls class="w-full h-auto object-cover">
                            Browser Anda tidak mendukung pemutar video.
                        </video>
                        @else
                        <img src="{{ $file->temporaryUrl() }}" class="w-full h-auto object-cover">
                        @endif
                    </div>

                    <!-- New File Info -->
                    <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div>
                                <span class="font-semibold">Tipe File Baru:</span>
                                <span>{{ $this->isVideoFile($file) ? 'Video' : 'Gambar' }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Ukuran Baru:</span>
                                <span>{{ $currentFileSize }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="flex justify-between">
                        <x-modified-date :updated_at="$updated_at" />

                        <div class="flex space-x-2">
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
                                <span wire:loading.remove wire:target="file">Simpan</span>
                                <span wire:loading wire:target="file">Proses Simpan...</span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layouts.content>