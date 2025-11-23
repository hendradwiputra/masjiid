<x-layouts.content>
    <x-session-message />

    <div class="flex items-center">
        <img src="{{ asset('storage/images/icon/point.png') }}" class="h-5" alt="Point Icon">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Galeri</h1>
    </div>

    <div class="border border-gray-200 rounded-2xl shadow-sm">
        <div class="px-5 py-5 rounded-t-2xl">
            <div class="flex justify-end items-center">
                <button wire:click="create"
                    class="flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Unggah Media
                </button>
            </div>
        </div>

        <div class="p-5">
            @if ($images->isEmpty())
            <div
                class="flex flex-col items-center justify-center py-16 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                <svg class="h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-lg font-semibold text-gray-600 mb-2">Belum ada gambar</p>
                <p class="text-sm text-gray-500 text-center max-w-md">Mulai dengan mengunggah gambar pertama Anda untuk
                    melihat pratinjau di sini.</p>
                <button wire:click="create"
                    class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Unggah Gambar Pertama
                </button>
            </div>
            @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach ($images as $image)
                <div
                    class="group relative bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
                    <!-- Media Container -->
                    <div class="aspect-square bg-gray-100 relative overflow-hidden">
                        @if ($image->isImage())
                        <img src="{{ asset('storage/' . $image->file_name) }}" alt="image {{ $image->id }}"
                            class="bg-gray-300 w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                            loading="lazy">
                        @else
                        <video class="bg-gray-300 w-full h-full object-cover" controls>
                            <source src="{{ asset('storage/' . $image->file_name) }}" type="{{ $image->mime_type }}">
                            Browser Anda tidak mendukung pemutar video.
                        </video>
                        @endif

                        <!-- File Size -->
                        <div class="absolute top-2 right-2">
                            <span class="px-2 py-1 bg-black bg-opacity-70 text-white text-xs rounded-md">
                                {{ $this->formatFileSize($image->file_size) }}
                            </span>
                        </div>

                        <!-- Hover Overlay with Actions -->
                        <div
                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-200 flex items-center justify-center opacity-0 group-hover:opacity-90">
                            <div class="flex gap-2">
                                <button wire:click="edit({{ $image->id }})"
                                    class="p-2 bg-white rounded-full shadow-lg hover:bg-blue-50 transition-colors transform scale-90 group-hover:scale-100"
                                    title="Edit">
                                    <svg class="h-4 w-4 text-gray-700" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor">
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </button>
                                <button wire:click="confirmDelete({{ $image->id }})"
                                    class="p-2 bg-white rounded-full shadow-lg hover:bg-red-50 transition-colors transform scale-90 group-hover:scale-100"
                                    title="Delete">
                                    <svg class="h-4 w-4 text-red-600" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor">
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Info Footer -->
                    <div class="p-3">
                        <p class="text-xs font-medium text-gray-900 truncate mb-1">
                            {{ $image->mime_type }}
                        </p>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="h-3 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                <path d="M9 15l3 -3l3 3" />
                                <path d="M12 12l0 9" />
                            </svg>
                            <span>{{ $image->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 pt-6">
                {{ $images->links() }}
            </div>
            @endif
        </div>
    </div>

    <x-delete-modal />
</x-layouts.content>