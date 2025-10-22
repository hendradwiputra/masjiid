<x-layouts.content>
    <x-session-message />

    <div class="flex items-center">
        <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Pengaturan Teks Berjalan</h1>
    </div>

    <div class="space-y-6">
        <div class="border border-gray-200 rounded-2xl shadow-2xl">
            <div class="px-5 py-5 rounded-t-2xl">
                <div class="flex justify-end">
                    <button wire:click="resetForm"
                        class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Tambah Teks
                    </button>
                </div>
            </div>

            <div class="p-5">
                @if ($runningTexts->isEmpty())
                <div class="flex items-center justify-center">
                    <svg class="h-7 w-7 mr-2" viewBox="0 0 24 24" fill="none" stroke="#ff3b30" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                        <path d="M12 8v4" />
                        <path d="M12 16h.01" />
                    </svg>
                    <p class="text-base text-gray-600 font-semibold">Belum ada informasi baru.</p>
                </div>
                @else
                <table class="w-full table-auto">
                    <thead class="text-sm text-gray-700">
                        <tr class="bg-gray-100 border-t border-gray-200">
                            <th class="px-4 py-2 text-left">
                                Tanggal Publikasi
                            </th>
                            <th class="px-4 py-2 text-left">
                                <button wire:click="sortBy('announcement')" class="flex items-center">
                                    Informasi
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortField === 'announcement' && $sortDirection === 'asc' ? 'M19 9l-7 7-7-7' : 'M5 15l7-7 7 7' }}" />
                                    </svg>
                                </button>
                            </th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($runningTexts as $runningText)
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2">
                                @if ($runningText->status === 'Aktif')
                                <span
                                    class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Aktif</span>
                                @elseif ($runningText->status === 'Berakhir')
                                <span
                                    class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Berakhir</span>
                                @else
                                <span
                                    class="inline-flex items-center rounded-md bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/20">Nonaktif</span>
                                @endif
                                <p class="text-sm">{{ $runningText->start_date->format('d M Y') }} -
                                    {{ $runningText->end_date->format('d M Y') }}</p>
                            </td>
                            <td class="px-4 py-2">
                                <p class="text-base font-medium">{{ Str::limit($runningText->announcement, 100) }}</p>
                                <p class="text-sm">
                                    Status Informasi :
                                    <x-status-badge :active="$runningText->status_id == 1" />
                                </p>
                            </td>
                            <td class="px-4 py-2">
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $runningTexts->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <div x-data="{ showModal: @entangle('showModal') }" x-show="showModal" x-cloak
        class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-lg p-6 w-full max-w-xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="flex items-center text-lg font-semibold">
                    <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M9 9l1 0" />
                        <path d="M9 13l6 0" />
                        <path d="M9 17l6 0" />
                    </svg>
                    {{ $editMode ? 'Edit Informasi' : 'Tambah Informasi' }}
                </h2>
                <button @click="showModal = false" wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="overflow-y-auto max-h-[80vh]">
                <form wire:submit.prevent="save">
                    <div class="mb-4 mt-4">
                        <label class="flex justify-between items-center cursor-pointer">
                            <span class="text-base font-semibold text-gray-900 dark:text-gray-300">Status
                                Informasi</span>
                            <div class="relative">
                                <input type="checkbox" class="sr-only peer" wire:model.live="status_id" {{ $status_id==1
                                    ? 'checked' : '' }}>
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Ketik Informasi</label>
                        <textarea wire:model="announcement"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none"
                            rows="3"></textarea>
                        @error('announcement')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Tanggal Publikasi</label>
                        <input type="date" wire:model="start_date"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                        @error('start_date')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Tanggal Berakhir</label>
                        <input type="date" wire:model="end_date"
                            class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                        @error('end_date')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-between mt-10">
                        <div class="flex">
                            @if ($editMode)
                            <x-modified-date :updated_at="$updated_at" />
                            @endif
                        </div>

                        <div class="flex space-x-2">
                            <button wire:click="closeModal" type="button"
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
                                class="flex items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4 text-base text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                                <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                </svg>
                                <span wire:loading.remove>{{ $editMode ? 'Update' : 'Simpan' }}</span>
                                <span wire:loading>Proses {{ $editMode ? 'Update' : 'Simpan' }}...</span>
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