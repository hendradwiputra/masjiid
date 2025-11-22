<x-layouts.content>
    <x-session-message />

    <div class="flex items-center">
        <img src="{{ asset('storage/images/icon/point.png') }}" class="h-5" alt="Point Icon">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Slide Gambar</h1>
    </div>

    <div class="space-y-6">
        <div class="border border-gray-200 rounded-2xl shadow-sm">
            <div class="px-5 py-5 rounded-t-2xl">
                <div class="flex justify-end">
                    <button wire:click="create"
                        class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Tambah Slide
                    </button>
                </div>
            </div>

            <div class="p-5">
                @if ($slide_images->isEmpty())
                <div class="flex flex-col items-center justify-center py-12">
                    <svg class="h-16 w-16 text-gray-300 mb-4" fill="none" stroke="#ccc" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-base text-gray-600 font-semibold">Belum ada slide gambar.</p>
                </div>
                @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($slide_images as $slide)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                        <!-- Media Preview -->
                        <div class="relative bg-gray-50 h-48 flex items-center justify-center overflow-hidden">
                            @if($slide->image && file_exists(public_path('storage/' . $slide->image->file_name)))
                            @php
                            $isImage = str_starts_with($slide->image->mime_type ?? '', 'image/');
                            @endphp

                            @if($isImage)
                            <img src="{{ asset('storage/' . $slide->image->file_name) }}" alt="{{ $slide->title }}"
                                class="w-full h-full object-cover">
                            @else
                            <video class="w-full h-full object-cover" controls preload="metadata">
                                <source src="{{ asset('storage/' . $slide->image->file_name) }}"
                                    type="{{ $slide->image->mime_type }}">
                                Video tidak didukung.
                            </video>
                            @endif

                            <!-- Status Badge on Top Right -->
                            <div class="absolute top-3 right-3 z-10">
                                @if ($slide->status === 'Aktif')
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded">Aktif</span>
                                @elseif ($slide->status === 'Berakhir')
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-1 rounded">Berakhir</span>
                                @else
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-1 rounded">Terjadwal</span>
                                @endif
                            </div>
                            @else
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="text-sm">Media tidak ditemukan</span>
                            </div>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="p-2 space-y-3 flex-grow">
                            <!-- Slide status -->
                            <div class="flex justify-between">
                                <div>
                                    @if ($slide->status_id == 1)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded">Published</span>
                                    @else
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-semibold border border-gray-400 px-2.5 py-1 rounded">Draft</span>
                                    @endif
                                </div>

                                <div
                                    class="bg-gray-100 text-gray-800 text-xs font-semibold border border-gray-400 px-2.5 py-1 rounded">
                                    @if ($slide->fullscreen_mode == 1)
                                    <span>Fullscreen Slide</span>
                                    @else
                                    <span>Normal Slide</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Published date -->
                            <div class="text-xs font-semibold text-gray-500">
                                <p>{{ $slide->start_date->format('d M Y') }} - {{ $slide->end_date->format('d M Y') }}
                                </p>
                            </div>

                            <!-- Slide title and description -->
                            <h3 class="font-semibold text-gray-900 truncate">{{ $slide->title }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($slide->content, 80) }}</p>
                        </div>

                        <!-- Action Buttons - Now at the bottom -->
                        <div class="p-4 pt-2 mt-auto">
                            <div class="flex justify-end">
                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <button wire:click="edit({{ $slide->id }})" type="button"
                                        class="px-2 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $slide->id }})" type="button"
                                        class="px-2 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
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
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $slide_images->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-delete-modal />

</x-layouts.content>