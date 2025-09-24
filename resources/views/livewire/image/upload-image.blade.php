<x-layouts.content>
    @if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
        class="flex items-center p-3 mt-2 mb-4 font-semibold text-green-800 bg-green-100">
        <svg class="h-6 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 11l3 3l8 -8" />
            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
        </svg>
        {{ session('message') }}
    </div>
    @endif

    <div class="flex items-center">
        <img src="{{ asset('storage/images/icon/point.png') }}" class="h-5" alt="Point Icon">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Pengaturan Gambar</h1>
    </div>

    <div class="space-y-6">
        <div class="border border-gray-200 rounded-t-2xl">
            <div class="px-2 py-3 bg-stone-100 rounded-t-2xl">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <svg class="h-6 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                            <path
                                d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" />
                            <path d="M17 7h.01" />
                            <path d="M7 13l3.644 -3.644a1.21 1.21 0 0 1 1.712 0l3.644 3.644" />
                            <path d="M15 12l1.644 -1.644a1.21 1.21 0 0 1 1.712 0l2.644 2.644" />
                        </svg>
                        <h3 class="text-base font-bold">Koleksi Gambar</h3>
                    </div>
                    <button wire:click="resetForm"
                        class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Upload Gambar
                    </button>
                </div>
            </div>

            <div class="border-t border-gray-200 p-5">
                <table class="w-full table-auto">
                    <thead class="text-sm md:text-base">
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left">
                                Status
                            </th>
                            <th class="px-4 py-2 text-left">
                                Gambar
                            </th>
                            <th class="px-4 py-2 text-left">
                                <button wire:click="sortBy('category')" class="flex items-center">
                                    Kategori
                                    @if ($sortField === 'category')
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
                            <th class="px-4 py-2 text-left">
                                Tindakan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @if ($images->count())
                        @foreach ($images as $image)
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2">
                                @if ($image->status === 'Aktif')
                                <span
                                    class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Aktif</span>
                                @elseif ($image->status === 'Berakhir')
                                <span
                                    class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Berakhir</span>
                                @else
                                <span
                                    class="inline-flex items-center rounded-md bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/20">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/' . $image->image_name) }}"
                                    alt="{{ $image->category }} image"
                                    class="bg-stone-700 w-25 h-15 object-cover rounded">
                            </td>
                            <td class="px-4 py-2">
                                {{ $image->category }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $image->start_date->format('d M Y') }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $image->end_date->format('d M Y') }}
                            </td>
                            <td class="px-4 py-2">
                                <button wire:click="edit({{ $image->id }})" class="text-blue-600">
                                    <svg class="h-5 w-5 hover:bg-blue-100" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </button>
                                <button wire:click="confirmDelete({{ $image->id }})" class="text-red-600 ml-1">
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
                        @else
                        <p class="text-gray-600">No images uploaded yet.</p>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            {{ $images->links() }}
        </div>
    </div>

    <!-- Add Modal -->
    <div x-data="{ showModal: @entangle('showModal') }" x-show="showModal" x-cloak
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="overflow-y-auto max-h-[80vh]">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Upload Gambar</h2>
                    <button @click="showModal = false" wire:click="closeModal"
                        class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6L6 18" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="save" enctype="multipart/form-data"
                    x-data="{ category: @entangle('category') }">
                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Kategori gambar</label>
                        <select wire:model="category"
                            class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Silahkan pilih</option>
                            <option value="1">Logo</option>
                            <option value="2">Slide Gambar</option>
                            <option value="3">Slide Jumbotron</option>
                        </select>

                        @error('category')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror

                        <div class="mb-4 mt-2 text-gray-600 text-sm">
                            <div x-show="category === '1'">Gambar ini akan digunakan untuk logo masjid</div>
                            <div x-show="category === '2'">Slide gambar akan tampil dalam jam shalat Masjid</div>
                            <div x-show="category === '3'">Slide gambar akan tampil dalam mode fullscreen</div>
                        </div>

                    </div>

                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Pilih gambar</label>
                        <input type="file" wire:model.live="image_name" accept="image/*"
                            class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('image_name')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($image_name)
                    <label class="block text-base font-semibold mb-2">Pratinjau</label>
                    <img src="{{ $image_name->temporaryUrl() }}"
                        class="bg-stone-700 mt-3 mb-3 max-w-full h-auto object-cover rounded">
                    @endif

                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Tanggal Mulai</label>
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

                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal"
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
                        <button type="submit" wire:loading.attr="disabled" wire:target="image_name"
                            class="flex items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4 text-base text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                            <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                <path d="M9 15l3 -3l3 3" />
                                <path d="M12 12l0 9" />
                            </svg>
                            <span wire:loading.remove wire:target="image_name">Simpan</span>
                            <span wire:loading wire:target="image_name">Proses Simpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-data="{ showEditModal: @entangle('showEditModal') }" x-show="showEditModal" x-cloak
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="overflow-y-auto max-h-[80vh]">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Edit Gambar</h2>
                    <button @click="showEditModal = false" wire:click="closeModal"
                        class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6L6 18" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="update" enctype="multipart/form-data"
                    x-data="{ category: @entangle('category') }">
                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Kategori gambar</label>
                        <select wire:model="category"
                            class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Silahkan pilih</option>
                            <option value="1">Logo</option>
                            <option value="2">Slide Gambar</option>
                            <option value="3">Slide Jumbotron</option>
                        </select>
                        @error('category')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                        <div class="mb-4 mt-2 text-gray-600 text-sm">
                            <div x-show="category === '1'">Gambar ini akan digunakan untuk logo masjid</div>
                            <div x-show="category === '2'">Slide gambar akan tampil dalam jam shalat Masjid</div>
                            <div x-show="category === '3'">Slide gambar akan tampil dalam mode fullscreen</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Gambar saat ini</label>
                        @if ($selectedImageName)
                        <img src="{{ asset('storage/' . $selectedImageName) }}"
                            class="bg-stone-700 max-w-full h-auto object-cover rounded">
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Pilih gambar baru</label>
                        <input type="file" wire:model.live="image_name" accept="image/*"
                            class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('image_name')
                        <span class="text-red-500 text-base">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($image_name)
                    <label class="block text-base font-semibold mb-2">Pratinjau</label>
                    <img src="{{ $image_name->temporaryUrl() }}"
                        class="bg-stone-700 mt-3 mb-3 max-w-full h-auto object-cover rounded">
                    @endif

                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2">Tanggal Mulai</label>
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

                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal"
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
                        <button type="submit" wire:loading.attr="disabled" wire:target="image_name"
                            class="flex items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4 text-base text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                            <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0 -2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2 -2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1 -4 9.5 -9.5z" />
                            </svg>
                            <span wire:loading.remove wire:target="image_name">Update</span>
                            <span wire:loading wire:target="image_name">Proses Update...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ showDeleteModal: @entangle('showDeleteModal') }" x-show="showDeleteModal" x-cloak
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Hapus Gambar</h2>
                <button @click="showDeleteModal = false" wire:click="closeModal"
                    class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="mb-4">Anda yakin akan menghapus gambar ini?</p>
            <div class="flex justify-end space-x-2">
                <button type="button" wire:click="closeModal"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
                <button wire:click="delete" wire:loading.attr="disabled"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    <span wire:loading.remove>Hapus</span>
                    <span wire:loading>Proses Hapus...</span>
                </button>
            </div>
        </div>
    </div>
</x-layouts.content>