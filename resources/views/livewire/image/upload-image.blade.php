<x-layouts.content>
    @if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
        class="flex items-center p-3 mt-2 mb-4 font-medium text-green-800 bg-green-100">
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
        <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Upload</h1>
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
                        <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Upload Gambar
                    </button>
                </div>
            </div>

            <div class="border-t border-gray-200 p-5">
                @if ($images->count())
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($images as $image)
                    <div class="border border-gray-200 rounded p-1 shadow relative">
                        <img src="{{ asset('storage/' . $image->image_name) }}" alt="{{ $image->category }} image"
                            class="bg-stone-700 max-w-full h-auto object-cover rounded">
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <button wire:click="edit({{ $image->id }})" class="text-white hover:text-gray-200">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0 -2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2 -2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1 -4 9.5 -9.5z" />
                                </svg>
                            </button>
                            <button wire:click="confirmDelete({{ $image->id }})" class="text-white hover:text-gray-200">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18" />
                                    <path d="M8 6V4a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v2" />
                                    <path d="M6 6v14a1 1 0 0 0 1 1h10a1 1 0 0 0 1 -1V6" />
                                    <path d="M10 11v6" />
                                    <path d="M14 11v6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $images->links() }}
                </div>
                @else
                <p class="text-gray-600">No images uploaded yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div x-data="{ showModal: @entangle('showModal') }" x-show="showModal" x-cloak
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Upload Gambar</h2>
                <button @click="showModal = false" wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form wire:submit.prevent="save" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-base font-medium mb-2">Kategori Photo</label>
                    <select wire:model="category"
                        class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih kategori</option>
                        <option value="1">Logo</option>
                        <option value="2">Wallpaper</option>
                    </select>
                    @error('category')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-base font-medium mb-2">Pilih Photo</label>
                    <input type="file" wire:model.live="image_name" accept="image/*"
                        class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('image_name')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                </div>
                @if ($image_name)
                <img src="{{ $image_name->temporaryUrl() }}"
                    class="bg-stone-700 mt-3 mb-3 max-w-full h-auto object-cover rounded">
                @endif
                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Cancel
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="image_name"
                        class="flex items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4 text-base text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                        <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                            <path d="M9 15l3 -3l3 3" />
                            <path d="M12 12l0 9" />
                        </svg>
                        <span wire:loading.remove wire:target="image_name">Upload</span>
                        <span wire:loading wire:target="image_name">Proses Upload...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-data="{ showEditModal: @entangle('showEditModal') }" x-show="showEditModal" x-cloak
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
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
            <form wire:submit.prevent="update" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-base font-medium mb-2">Edit Kategori</label>
                    <select wire:model="category"
                        class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih kategori</option>
                        <option value="1">Logo</option>
                        <option value="2">Wallpaper</option>
                    </select>
                    @error('category')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-base font-medium mb-2">Pilih photo baru</label>
                    <input type="file" wire:model.live="image_name" accept="image/*"
                        class="text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('image_name')
                    <span class="text-red-500 text-base">{{ $message }}</span>
                    @enderror
                </div>
                @if ($image_name)
                <img src="{{ $image_name->temporaryUrl() }}"
                    class="bg-stone-700 mt-3 mb-3 max-w-full h-auto object-cover rounded">
                @elseif ($selectedImageName)
                <img src="{{ asset('storage/' . $selectedImageName) }}"
                    class="bg-stone-700 mt-3 mb-3 max-w-full h-auto object-cover rounded">
                @endif
                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Cancel
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="image_name"
                        class="flex items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4 text-base text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                        <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
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