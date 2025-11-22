<div x-data="{ showImageModal: @entangle('showImageModal') }" x-show="showImageModal" x-cloak
    class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-4xl">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-lg font-semibold">Galeri</h2>
            <button @click="showImageModal = false" wire:click="closeImageModal"
                class="text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="overflow-y-auto max-h-[80vh]">
            @if ($images->count())
            <div class="grid grid-cols-4 gap-4">
                @foreach ($images as $image)
                <div class="border border-gray-200 rounded p-1 shadow cursor-pointer"
                    wire:click="selectImage({{ $image->id }})">
                    @if ($image->isImage())
                    <img src="{{ asset('storage/' . $image->file_name) }}" alt="image {{ $image->id }}"
                        class="bg-stone-400 w-full h-40 object-contain hover:scale-105 transition-transform duration-300"
                        loading="lazy">
                    @else
                    <video class="bg-stone-400 w-full h-40 object-cover" controls>
                        <source src="{{ asset('storage/' . $image->file_name) }}" type="{{ $image->mime_type }}">
                        Browser Anda tidak mendukung pemutar video.
                    </video>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-600">No logos available. Please upload a logo in the image gallery.</p>
            @endif
        </div>
    </div>
</div>