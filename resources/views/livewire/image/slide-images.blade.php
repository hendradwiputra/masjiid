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
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Slide Gambar</h1>
    </div>

    <div class="space-y-6">
        <div class="border border-gray-200 rounded-2xl shadow-2xl">
            <div class="px-2 py-3 bg-stone-100 rounded-t-2xl">
                <div class="flex justify-end">
                    <button wire:click="resetForm"
                        class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Tambah Slide
                    </button>
                </div>
            </div>

            <div class="border-t border-gray-200 p-5">
                @if ($slide_images->isEmpty())
                <div class="flex items-center justify-center">
                    <svg class="h-7 w-7 mr-2" viewBox="0 0 24 24" fill="none" stroke="#ff3b30" stroke-width="1.25"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                        <path d="M12 8v4" />
                        <path d="M12 16h.01" />
                    </svg>
                    <p class="text-base text-gray-600 font-semibold">Belum ada slide gambar.</p>
                </div>
                @else
                <table class="w-full table-auto">
                    <thead class="text-sm md:text-base">
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Gambar</th>
                            <th class="px-4 py-2 text-left">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($slide_images as $slide)
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2">
                                <span
                                    class="inline-block px-2 py-1 text-xs font-medium rounded {{ $slide->status_id == 1 ? 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20' : 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/20' }}">
                                    {{ $slide->status_id == 1 ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                @if($slide->image)
                                <img src="{{ asset('storage/' . $slide->image->image_name) }}" alt="Slide Image"
                                    class="h-16 w-16 bg-stone-400 object-cover rounded">
                                @else
                                <span class="text-gray-400">Gambar tidak ditemukan</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $slide_images->links() }}
                </div>
                @endif
            </div>
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
                <button wire:click="cancel" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Batal
                </button>
                <button wire:click="delete" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </div>
    </div>

</x-layouts.content>