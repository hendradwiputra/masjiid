<div class="bg-gray-100 flex h-screen items-center justify-center ">
    <div class="w-full max-w-md">
        <div class="font-mavenpro bg-white shadow-md rounded-xl px-6 py-8">
 
            <h2 class="my-2 text-center text-4xl font-bold text-gray-900">
                Login
            </h2>

            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('storage/images/icon/masjiid.png') }}" alt="logo" class="h-10">
            </div>

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-center text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form class="space-y-4" wire:submit="login">

                <div>
                    <label for="new-password" class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1">
                        <input name="name" type="name"
                            class="@error('name') is-invalid @enderror px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" id="name" wire:model="name"/>
                            @if ($errors->has('name'))
                                <span class="text-red-500 text-sm">{{ $errors->first('name') }}</span>
                            @endif
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input name="password" type="password"
                            class="@error('password') is-invalid @enderror px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" id="password" wire:model="password"/>
                            @if ($errors->has('password'))
                                <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                            @endif
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-full border border-transparent bg-blue-500 hover:bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">Login    
                    </button>
                    <div class="text-center mb-3 row"> 
                        <span wire:loading class="col-md-3 offset-md-5 text-primary">Processing...</span>
                    </div>
                </div>
                <p class="text-center text-sm text-gray-900">
                    Tidak punya akun? Buat akun baru <a href="{{ route('register') }}" class="text-blue-500 hover:underline font-semibold">di sini</a>
                </p>
            </form>
        </div>
    </div>
</div>