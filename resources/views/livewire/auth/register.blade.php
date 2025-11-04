<div class="bg-gray-100 flex h-screen items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="bg-white shadow-md rounded-md p-6">

            <h2 class="my-2 text-center text-3xl font-semibold tracking-tight text-gray-900">
                Pendaftaran Akun Baru
            </h2>

            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('/storage/images/icon/masjiid.png') }}" alt="logo" class="h-10">
            </div>

            <form wire:submit="store" class="space-y-6">

                <div>
                    <label for="name" class="block text-base font-medium text-gray-700">Username</label>
                    <div class="mt-1">
                        <input wire:model="name" type="text"
                            class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-base" />
                        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-base font-medium text-gray-700">Email</label>
                    <div class="mt-1">
                        <input wire:model="email" type="email"
                            class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-base" />
                        @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-base font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input wire:model="password" type="password"
                            class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-base" />
                        @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-base font-medium text-gray-700">Konfirmasi
                        Password</label>
                    <div class="mt-1">
                        <input wire:model="password_confirmation" type="password"
                            class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-base" />
                        <!-- Password confirmation error will show here -->
                        @error('password')
                        @if ($message === 'Konfirmasi password tidak cocok.')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                        @endif
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-full border border-transparent bg-blue-500 hover:bg-blue-600 py-2 px-4 text-base font-medium text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>