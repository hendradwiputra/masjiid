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
                        <h3 class="text-base font-bold">
                            Koleksi Gambar
                        </h3>
                    </div>
                    <!-- Add New Button -->
                    <button class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add New Image
                    </button>
                </div>
            </div>

            <div class="border-t border-gray-200 p-5">
                @if ($images->count())
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($images as $image)
                    <div class="border border-gray-200 rounded p-1 shadow">
                        <img src="{{ asset('storage/' . $image->image_name) }}" alt="{{ $image->category }}"
                            class="bg-stone-800 w-50 h-50 object-cover rounded">
                        <div class="mt-2 text-center">
                            <p class="text-sm font-medium">{{ $image->id }}</p>
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

            <div class="px-2 py-2 mt-3 border border-gray-200 bg-stone-100">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <svg class="h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" />
                            <path d="M16 3v4" />
                            <path d="M8 3v4" />
                            <path d="M4 11h10" />
                            <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M18 16.5v1.5l.5 .5" />
                        </svg>
                        <p class="text-sm">
                            {{ $updated_at }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <form wire:submit.prevent="save" enctype="multipart/form-data">

            <div class="mb-4">
                <label class="block text-sm font-medium">Category</label>
                <select wire:model="category"
                    class="text-sm lg:text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Kategori Photo</option>
                    <option value="1">Logo</option>
                    <option value="2">Wallpaper</option>
                </select>
                @error('category') <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Photo</label>
                <input type="file" wire:model.live="image_name"
                    class="text-sm lg:text-base bg-stone-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('image_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

            </div>

            @if ($image_name)
            <img src="{{ $image_name->temporaryUrl() }}" class="bg-stone-800 mt-3 w-50 h-50 object-cover rounded">
            @endif

            <div class="flex justify-end space-x-2">
                <div class="flex justify-end space-x-2">
                    <button type="submit" wire:loading.attr="disabled" wire:target="upload"
                        class="flex items-center border border-transparent bg-blue-600 hover:bg-blue-700 rounded-lg py-2 px-4 text-base text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                        <svg class="h-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                            <path d="M9 15l3 -3l3 3" />
                            <path d="M12 12l0 9" />
                        </svg>
                        <span wire:loading.remove wire:target="upload">Upload</span>
                        <span wire:loading wire:target="upload">Uploading...</span>
                    </button>
                </div>
            </div>

        </form>
    </div>

</x-layouts.content>