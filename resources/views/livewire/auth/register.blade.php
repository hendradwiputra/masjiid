<div class="bg-gray-100 flex h-screen items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="font-mavenpro bg-white shadow-md rounded-md p-6">

            <h2 class="my-2 text-center text-3xl font-bold tracking-tight text-gray-900">
                Pendaftaran Akun Baru
            </h2>

            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('/storage/images/icon/masjiid.png') }}" alt="logo" class="h-10">
            </div>

            <form class="space-y-6" method="POST">

                <div>
                    <label for="new-password" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="mt-1">
                        <input name="username" type="username" required
                            class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1">
                        <input name="email" type="email-address" autocomplete="email-address" required
                            class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input name="password" type="password" autocomplete="password" required
                            class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="mt-1">
                        <input name="confirm_password" type="password" autocomplete="confirm-password" required
                            class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" />
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-full border border-transparent bg-blue-500 hover:bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                        Daftar Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>