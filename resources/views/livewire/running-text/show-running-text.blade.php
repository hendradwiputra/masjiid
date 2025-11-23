<x-layouts.content>
    <x-session-message />

    <div class="flex items-center">
        <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Pengaturan Teks Berjalan</h1>
    </div>

    <div class="space-y-6">
        <div class="border border-gray-200 rounded-2xl shadow-sm">
            <div class="px-5 py-5 rounded-t-2xl">
                <div class="flex justify-end items-center">
                    <button wire:click="resetForm"
                        class="flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Teks
                    </button>
                </div>
            </div>

            <div class="p-5">
                @if ($runningTexts->isEmpty())
                <div
                    class="flex flex-col items-center justify-center py-16 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                    <svg class="h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <p class="text-lg font-semibold text-gray-600 mb-2">Belum ada teks berjalan</p>
                    <p class="text-sm text-gray-500 text-center max-w-md">Mulai dengan menambahkan teks berjalan pertama
                        untuk ditampilkan.</p>
                    <button wire:click="resetForm"
                        class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Tambah Teks Pertama
                    </button>
                </div>
                @else

                <!-- Grid Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($runningTexts as $runningText)
                    <div
                        class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden flex flex-col h-full">
                        <!-- Header with Status -->
                        <div class="p-4 border-b border-gray-100">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    @if ($runningText->status === 'Aktif')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1"></span>
                                        Aktif
                                    </span>
                                    @elseif ($runningText->status === 'Berakhir')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <span class="w-1.5 h-1.5 bg-red-400 rounded-full mr-1"></span>
                                        Berakhir
                                    </span>
                                    @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        <span class="w-1.5 h-1.5 bg-amber-400 rounded-full mr-1"></span>
                                        Nonaktif
                                    </span>
                                    @endif
                                </div>
                                <x-status-badge :active="$runningText->status_id == 1" />
                            </div>

                            <!-- Date Range -->
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $runningText->start_date->format('d M Y') }} - {{
                                    $runningText->end_date->format('d M Y') }}</span>
                            </div>
                        </div>

                        <!-- Content - This section will grow to push actions to bottom -->
                        <div class="p-4 flex-grow">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Informasi:</h3>
                            <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed">
                                {{ $runningText->announcement }}
                            </p>
                        </div>

                        <!-- Actions - This will always be at the bottom -->
                        <div class="px-4 py-3 bg-gray-50 border-t border-gray-100 mt-auto">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">
                                    Diperbarui: {{ $runningText->updated_at->diffForHumans() }}
                                </span>
                                <div class="flex space-x-1">
                                    <div class="inline-flex rounded-md shadow-sm" role="group">
                                        <button wire:click="edit({{ $runningText->id }})" type="button"
                                            class="px-2 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <button wire:click="confirmDelete({{ $runningText->id }})" type="button"
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
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 pt-6">
                    {{ $runningTexts->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <div x-data="{ showModal: @entangle('showModal') }" x-show="showModal" x-cloak
        class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden">
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h2 class="flex items-center text-xl font-semibold text-gray-900">
                    <svg class="h-6 w-6 mr-2 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M9 9l1 0" />
                        <path d="M9 13l6 0" />
                        <path d="M9 17l6 0" />
                    </svg>
                    {{ $editMode ? 'Edit Informasi' : 'Tambah Informasi' }}
                </h2>
                <button @click="showModal = false" wire:click="closeModal"
                    class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M18 6L6 18" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="overflow-y-auto max-h-[calc(90vh-140px)]">
                <form wire:submit.prevent="save" class="p-6">
                    <!-- Status Toggle -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <label class="flex justify-between items-center cursor-pointer">
                            <div>
                                <span class="text-base font-semibold text-gray-900">Status Informasi</span>
                                <p class="text-sm text-gray-500 mt-1">Aktifkan untuk menampilkan teks berjalan</p>
                            </div>
                            <div class="relative">
                                <input type="checkbox" class="sr-only peer" wire:model.live="status_id" {{ $status_id==1
                                    ? 'checked' : '' }}>
                                <div
                                    class="w-12 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Announcement Text -->
                    <div class="mb-6">
                        <label class="block text-base font-semibold text-gray-900 mb-3">Ketik Informasi</label>
                        <textarea wire:model="announcement" placeholder="Masukkan teks berjalan..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition-colors"
                            rows="4"></textarea>
                        @error('announcement')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date Range -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-base font-semibold text-gray-900 mb-3">Tanggal Mulai</label>
                            <input type="date" wire:model="start_date"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('start_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-base font-semibold text-gray-900 mb-3">Tanggal Berakhir</label>
                            <input type="date" wire:model="end_date"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @error('end_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                        <div class="flex items-center text-sm text-gray-500">
                            @if ($editMode && $updated_at)
                            <x-modified-date :updated_at="$updated_at" />
                            @endif
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" wire:click="closeModal"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                Batal
                            </button>
                            <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-75"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                <span wire:loading.remove>{{ $editMode ? 'Update' : 'Simpan' }}</span>
                                <span wire:loading>Menyimpan...</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-delete-modal />
</x-layouts.content>