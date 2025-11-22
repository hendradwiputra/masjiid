<div x-data="{ showDeleteModal: @entangle('showDeleteModal') }" x-show="showDeleteModal" x-cloak
    class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-2">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                    stroke-linejoin="round" class="h-7 w-7">
                    <path d="M12 9v4" />
                    <path
                        d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                    <path d="M12 16h.01" />
                </svg>
                <h2 class="text-lg font-semibold">Konfirmasi Hapus</h2>
            </div>

            <button @click="$wire.cancel()" class="text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
        </div>
        <p class="mb-4">Apakah anda yakin ingin <strong>menghapus</strong> data ini?</p>
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