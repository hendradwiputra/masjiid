<x-layouts.content>
    <x-session-message />

    <form wire:submit="update">
        <div class="flex items-center">
            <img src="{{ '/storage/images/icon/point.png' }}" class="h-5" alt="logo">
            <h1 class="text-xl font-semibold text-gray-800 mb-6 mt-6">Edit Profile</h1>
        </div>

        <div class="grid grid-cols-1 max-w-2xl">
            <div class="space-y-6">
                <div class="border border-gray-200 rounded-2xl shadow-2xl p-6 space-y-6">

                    <!-- Username -->
                    <div>
                        <label class="block text-base font-semibold text-gray-700">Username</label>
                        <input wire:model.live="name" type="text"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-2 py-3 focus:border-sky-500 focus:ring-sky-500">
                        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-base font-semibold text-gray-700">Email</label>
                        <input wire:model.live="email" type="email"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-2 py-3 focus:border-sky-500 focus:ring-sky-500">
                        @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <h3 class="text-xl font-semibold mt-10">Ubah Password</h3>

                    <!-- Password -->
                    <div>
                        <label class="block text-base font-semibold text-gray-700">Password Baru</label>
                        <input wire:model.live="password" type="password"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-2 py-3 focus:border-sky-500 focus:ring-sky-500">
                        @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-base font-semibold text-gray-700">Konfirmasi Password</label>
                        <input wire:model.live="password_confirmation" type="password"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-2 py-3 focus:border-sky-500 focus:ring-sky-500">
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <x-modified-date :updated_at="$updated_at" />

                        <button type="submit" wire:loading.attr="disabled"
                            class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 px-6 flex items-center gap-2">
                            <span wire:loading.remove>Simpan</span>
                            <span wire:loading>Proses Simpan...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layouts.content>