<x-layouts.content>
    @if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
        class="flex item-center p-3 mt-2 mb-4 font-medium text-green-800 bg-green-100">
        <svg class="h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 11l3 3l8 -8" />
            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
        </svg>
        {{ session('message') }}
    </div>
    @endif

    <div class="flex items-center">
        <img src="{{ 'storage/images/icon/point.png' }}" class="h-5" alt="logo">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Pengaturan Teks Berjalan</h1>
    </div>

    <div class="space-y-6">
        <div class="border border-gray-200 rounded-t-2xl">
            <div class="px-2 py-3 bg-stone-100 rounded-t-2xl">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <svg class="h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                            <path d="M9 17h-2" />
                            <path d="M13 12h-6" />
                            <path d="M11 7h-4" />
                        </svg>
                        <h3 class="text-base font-bold">Tabel Informasi</h3>
                    </div>
                    <button wire:click="resetForm"
                        class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Tambah Informasi
                    </button>
                </div>
            </div>

            <div class="border-t border-gray-200 p-5">
                @if ($runningTexts->isEmpty())
                <p class="text-gray-600">Belum ada informasi baru.</p>
                @else
                <table class="w-full table-auto">
                    <thead class="text-sm md:text-base">
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left">
                                Status
                            </th>
                            <th class="px-4 py-2 text-left">
                                <button wire:click="sortBy('announcement')" class="flex items-center">
                                    Informasi
                                    @if ($sortField === 'announcement')
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M19 9l-7 7-7-7' : 'M5 15l7-7 7 7' }}" />
                                    </svg>
                                    @endif
                                </button>
                            </th>
                            <th class="px-4 py-2 text-left">
                                <button wire:click="sortBy('start_date')" class="flex items-center">
                                    Mulai
                                    @if ($sortField === 'start_date')
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M19 9l-7 7-7-7' : 'M5 15l7-7 7 7' }}" />
                                    </svg>
                                    @endif
                                </button>
                            </th>
                            <th class="px-4 py-2 text-left">
                                <button wire:click="sortBy('end_date')" class="flex items-center">
                                    Berakhir
                                    @if ($sortField === 'end_date')
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M19 9l-7 7-7-7' : 'M5 15l7-7 7 7' }}" />
                                    </svg>
                                    @endif
                                </button>
                            </th>
                            <th class="px-4 py-2 text-left">Tindakan</th>
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
                            </td>
                            <td class="px-4 py-2">{{ $runningText->announcement }}</td>
                            <td class="px-4 py-2">{{ $runningText->start_date->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ $runningText->end_date->format('d M Y') }}</td>
                            <td class="px-4 py-2">
                                <button wire:click="edit({{ $runningText->id }})" class="text-blue-600">
                                    <svg class="h-5 w-5 hover:bg-blue-100" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </button>
                                <button wire:click="confirmDelete({{ $runningText->id }})" class="text-red-600 ml-1">
                                    <svg class="h-5 w-5 hover:bg-red-100" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </button>
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
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">{{ $editMode ? 'Edit Informasi' : 'Tambah Informasi' }}</h2>
                <button @click="showModal = false" wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label class="block text-base font-medium mb-2">Informasi</label>
                    <textarea wire:model="announcement"
                        class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none"
                        rows="3"></textarea>
                    @error('announcement')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-base font-medium mb-2">Tanggal Mulai</label>
                    <input type="date" wire:model="start_date"
                        class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                    @error('start_date')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-base font-medium mb-2">Tanggal Berakhir</label>
                    <input type="date" wire:model="end_date"
                        class="text-sm lg:text-base mt-1 px-2 py-3 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none">
                    @error('end_date')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-75"
                        class="flex items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4 text-base text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                        <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                        <span wire:loading.remove>{{ $editMode ? 'Update' : 'Simpan' }}</span>
                        <span wire:loading>Proses {{ $editMode ? 'Update' : 'Simpan' }}...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ showDeleteModal: @entangle('showDeleteModal') }" x-show="showDeleteModal" x-cloak
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Konfirmasi Hapus</h2>
                <button @click="showDeleteModal = false" wire:click="closeDeleteModal"
                    class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="mb-4">Apakah Anda yakin ingin menghapus berita ini?</p>
            <div class="flex justify-end space-x-2">
                <button wire:click="closeDeleteModal"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
                <button wire:click="delete" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </div>
    </div>
</x-layouts.content>