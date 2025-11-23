<x-layouts.content>
    <div class="flex items-center mb-8">
        <img src="{{ asset('storage/images/icon/point.png') }}" class="h-5" alt="Point Icon">
        <h1 class="text-xl font-semibold text-gray-800 ml-2">Edit Slide</h1>
    </div>

    <form wire:submit="update">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Left Column - Media & Settings -->
            <div class="xl:col-span-1 space-y-6">
                <!-- Media Selection Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Media Slide</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Selected Media Preview -->
                        @if($image_id && $selectedImage)
                        <div class="text-center">
                            <div class="inline-block border-2 border-gray-200 rounded-lg p-1 bg-gray-50">
                                {{--
                                @if ($selectedImage->isImage())
                                <img src="{{ asset('storage/' . $selectedImage->file_name) }}" alt="Selected Image"
                                    class="max-h-48 w-auto object-contain rounded-lg mx-auto">
                                @else
                                <div class="relative">
                                    <video class="w-full h-full object-cover" controls preload="metadata"
                                        poster="{{ asset('storage/' . $selectedImage->file_name) }}">
                                        <source src="{{ asset('storage/' . $selectedImage->file_name) . '#t=0.1' }}"
                                            type="{{ $selectedImage->mime_type }}">
                                    </video>
                                    <div
                                        class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-20 rounded-lg">
                                        <div class="bg-black bg-opacity-50 rounded-full p-3">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                --}}
                                @if ($selectedImage->isImage())
                                <img src="{{ asset('storage/' . $selectedImage->file_name) }}" alt="Selected Image"
                                    class="h-full w-auto object-contain rounded-lg mx-auto">
                                @else
                                <div class="relative">
                                    <div class="aspect-video bg-gray-900 rounded-lg overflow-hidden">
                                        <video class="w-full max-h-48 object-cover" controls preload="metadata"
                                            id="video-{{ $selectedImage->id }}" data-thumbnail-generated="false">
                                            <source src="{{ asset('storage/' . $selectedImage->file_name) }}"
                                                type="{{ $selectedImage->mime_type }}">
                                        </video>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                    const video = document.getElementById('video-{{ $selectedImage->id }}');
                                    const thumbnailGenerated = video.getAttribute('data-thumbnail-generated');
                                    
                                    if (thumbnailGenerated === 'false') {
                                        video.addEventListener('loadeddata', function() {
                                            // Set current time to 1 second
                                            this.currentTime = 1;
                                        });
                                        
                                        video.addEventListener('seeked', function() {
                                            // Create canvas to capture frame
                                            const canvas = document.createElement('canvas');
                                            canvas.width = this.videoWidth;
                                            canvas.height = this.videoHeight;
                                            const ctx = canvas.getContext('2d');
                                            ctx.drawImage(this, 0, 0, canvas.width, canvas.height);
                                            
                                            // Set as poster
                                            this.poster = canvas.toDataURL();
                                            this.setAttribute('data-thumbnail-generated', 'true');
                                        });
                                    }
                                });
                                </script>
                                @endif
                            </div>
                        </div>
                        @else
                        <!-- Empty State -->
                        <div class="text-center py-8 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-gray-600 mb-4">Belum ada media yang dipilih</p>
                        </div>
                        @endif

                        <!-- Select File Button -->
                        <button type="button" wire:click="openImageModal"
                            class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Pilih Media
                        </button>
                        @error('image_id')
                        <p class="text-red-500 text-sm mt-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Settings Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Pengaturan</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Fullscreen Mode Toggle -->
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-base font-semibold text-gray-900 cursor-pointer">Full Screen
                                    Mode</label>
                                <p class="text-sm text-gray-500 mt-1">Tampilkan slide dalam mode layar penuh</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" wire:model.live="fullscreen_mode" {{
                                    $fullscreen_mode==1 ? 'checked' : '' }}>
                                <div
                                    class="w-12 h-6 bg-gray-200 peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </div>

                        <!-- Status Toggle -->
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-base font-semibold text-gray-900 cursor-pointer">Status Slide</label>
                                <p class="text-sm text-gray-500 mt-1">Aktifkan untuk menampilkan slide</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" wire:model.live="status_id" {{ $status_id==1
                                    ? 'checked' : '' }}>
                                <div
                                    class="w-12 h-6 bg-gray-200 peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Content & Dates -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Content Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Konten Slide</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Title -->
                        <div>
                            <label class="block text-base font-semibold text-gray-900 mb-3">Judul Slide</label>
                            <input type="text" wire:model="title" placeholder="Masukkan judul slide..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('title')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label class="block text-base font-semibold text-gray-900 mb-3">Isi Konten</label>
                            <textarea wire:model="content" placeholder="Tuliskan konten slide..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition-colors"
                                rows="6"></textarea>
                            @error('content')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div>
                            <label class="block text-base font-semibold text-gray-900 mb-3">Penulis</label>
                            <input type="text" wire:model="author" placeholder="Nama penulis..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('author')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Schedule Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Jadwal Publikasi</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Start Date -->
                            <div>
                                <label class="block text-base font-semibold text-gray-900 mb-3">Tanggal Mulai</label>
                                <input type="date" wire:model="start_date"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                @error('start_date')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label class="block text-base font-semibold text-gray-900 mb-3">Tanggal Berakhir</label>
                                <input type="date" wire:model="end_date"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                @error('end_date')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 pt-6">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <x-modified-date :updated_at="$updated_at" />
                <div class="flex space-x-3">
                    <button type="button" wire:click="cancel"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        Batal
                    </button>
                    <button type="submit" wire:loading.attr="disabled"
                        wire:loading.class="opacity-75 cursor-not-allowed"
                        class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span wire:loading.remove>Simpan Slide</span>
                        <span wire:loading>Menyimpan...</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Image Selection Modal -->
    @include('livewire.image.image-modal')
</x-layouts.content>